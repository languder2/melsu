<?php

namespace App\Models\Education;

use App\Enums\DurationType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Duration extends Model
{
    protected $table = 'durations';

    protected $fillable = [
        'type',
        'duration',
        'comment',
        'active',
        'sort',
    ];

    protected $visible = [
        'type',
        'duration',
        'comment',
        'active',
        'sort',
    ];

    protected $casts = [
        'code'  => DurationType::class,
    ];

    public function relation(): MorphTo
    {
        return $this->morphTo();
    }
    public static function processing($object,$list):void
    {

        foreach ($list as $type=>$form) {
            $type = DurationType::tryFrom($type);

            if(!$type) continue;

            $item = $object->duration()->where('type',$type)->first()
                ?? $object->duration()->create([
                    'type'      => $type,
                    'duration'  => 0,
                    'comment'   => $type->getComment(),
                ]);

            $duration = $form['years']*12 + $form['months'];
            $item->fill([
                'duration' => $duration,
                'active'   => (bool)$duration,
            ])->save();
        }
    }

}
