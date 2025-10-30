<?php

namespace App\Models\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Blade;
class Content extends Model
{
    use SoftDeletes;

    protected $table = 'contents';

    protected $fillable = [
        'type',
        'editor',
        'content',
    ];
    public function relation():MorphTo
    {
        return $this->morphTo();
    }
    public function fill(array $attributes):?self
    {
        if(array_key_exists('content', $attributes))
            $attributes['content'] = saveImagesFromContent($attributes['content']);

        return parent::fill($attributes);
    }

    public function getIdAttribute($value):int
    {
        return $value ?? now()->format('Uv');
    }
    public function updateWithLog($value):void
    {
        $this->fill(['content' => $value])->save();
        Log::withOrigin($this->relation, $this);

    }

    public function getName():string
    {
        return match ($this->type) {
            'relevance'             => __('projects.Relevance'),
            'goals'                 => __('projects.Goals and objectives'),
            'structure'             => __('projects.Structure'),
            'suggestions'           => __('projects.Suggestions for cooperation'),
            'available_resources'   => __('projects.Available resources'),
            'terms'                 => __('projects.Terms of implementation'),
            'funding'               => __('projects.Amount of funding'),
            'description'           => __('projects.Project Description'),
            'results'               => __('projects.Results and achievements'),
            'prospects'             => __('projects.Development prospects'),
            'full'                  => __('projects.full'),
            default                 => __('projects.Content'),
        };
    }

    public function customSave($content):void
    {
        if(!$this->exists && empty($content)) return;

        $this->fill(['content' => $content])->save();

        Log::withOrigin($this->relation, $this);
    }

    public function render()
    {
        $html = collect();

        $json = json_decode($this->getDataForEditorJS());

        foreach ($json->blocks as $key=>$block)
            $html->push(
                match ($block->type) {
                    'columns'   => view('components.editorjs.columns', ['data' => $block->data])->render(),
                    'header'    => view('components.editorjs.header', ['data' => $block->data])->render(),
                    'paragraph' => view('components.editorjs.paragraph', compact('block'))->render(),
                    'image'     => view('components.editorjs.image', compact('block'))->render(),
                    'gallery'   => view('components.editorjs.gallery', compact('block'))->render(),
                    'table'     => view('components.editorjs.table', compact('block'))->render(),
                    'quote'     => view('components.editorjs.quote', compact('block'))->render(),
                    'List'      => view('components.editorjs.list.base', compact('block'))->render(),
                    'code'      => Blade::render($block->data->code),
                    'raw'       => Blade::render($block->data->html),
                    default => $block->type,
                }
            );

        return $html->implode('');
    }


    public function getDataForEditorJS(): ?string
    {
        $json = json_decode($this->content);

        if($json || is_null($this->content))
            return $this->content;

        return json_encode((object)[
            "blocks" => [
                (object)[
                    'type'  => 'raw',
                    'data'  => (object)[
                        'html'  => $this->content
                    ]
                ],
            ],
        ]);
    }

}
