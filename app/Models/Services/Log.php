<?php

namespace App\Models\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Log extends Model
{
    protected $table = 'logs';

    protected $fillable = [
        'user_id',
        'action',
        'comment'
    ];
    public function relation():MorphTo
    {
        return $this->morphTo();
    }


    public static function add($object, string $action = 'update', ?string $comment= null)
    {
        $record = new self([
            'user_id'   => auth()->id(),
            'action'    => $action,
            'comment'   => $comment,
        ]);

        $record->relation()->associate($object);

        $record->save();
    }


}
