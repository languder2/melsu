<?php

namespace App\Models\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Content extends Model
{
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
        return $value ?? microtime(true);
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
