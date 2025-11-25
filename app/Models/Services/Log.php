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
        'comment',
        'dataOld',
        'dataNew',
    ];
    public function relation():MorphTo
    {
        return $this->morphTo();
    }
    public static function add($object, ?string $action = null, ?string $comment = null): void
    {
        if(empty($object->getDirty())) return;

        $record = new self([
            'user_id'   => auth()->id(),
            'action'    => $action ?? ($object->wasRecentlyCreated ? 'create' : 'update'),
            'dataOld'   => json_encode($object->getOriginal()),
            'dataNew'   => json_encode($object->getDirty()),
            'comment'   => $comment,
        ]);

        $record->relation()->associate($object)->save();
    }
}
