<?php

namespace App\Models\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Content extends Model
{
    use SoftDeletes;

    protected $table = 'contents';

    protected $fillable = [
        'type',
        'content',
    ];
    public function relation():MorphTo
    {
        return $this->morphTo();
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
            'relevance'     => __('projects.Relevance'),
            'goals'         => __('projects.Goals and objectives'),
            'structure'     => __('projects.Structure'),
            'suggestions'   => __('projects.Suggestions for cooperation'),
            'available_resources'
                            => __('projects.Available resources'),
            'terms'         => __('projects.Terms of implementation'),
            'funding'       => __('projects.Amount of funding'),
            'description'   => __('projects.Project Description'),
            'results'       => __('projects.Results and achievements'),
            'prospects'     => __('projects.Development prospects'),
            default         => __('projects.Content'),
        };
    }

    public function customSave($content):void
    {
        if(!$this->exists && empty($content)) return;

        $this->fill(['content' => $content])->save();

        Log::withOrigin($this->relation, $this);
    }


}
