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

    public function getYearsAttribute():string
    {
        return intdiv($this->duration,12);
    }
    public function getMonthsAttribute():string
    {
        return $this->duration % 12;
    }

    public function getDurationStringAttribute():string
    {
        $result = '';

        if($this->years)
            $result = $this->years." ".match(true){
                $this->years === 1  => __('duration-append.year-one'),
                $this->years > 4    => __('duration-append.year-many'),
                default             => __('duration-append.year-some'),
            };

        if($this->months)
            $result.= " ".$this->months." ".match(true){
                $this->months === 1 => __('duration-append.month-one'),
                $this->months > 4   => __('duration-append.month-many'),
                $this->months       => __('duration-append.month-some'),
           };

        return trim($result);
    }

}
