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
    public function origin():MorphTo
    {
        return $this->morphTo();
    }

    public static function add($object, ?string $action = null, ?string $comment = null): ?self
    {
        if(!$object->wasChanged() && !$object->wasRecentlyCreated && !$action)
            return null;

        $record = new self([
            'user_id'   => auth()->id(),
            'action'    => $action ?? ($object->wasRecentlyCreated ? 'create' : 'update'),
            'comment'   => $comment,
        ]);

        $record->relation()->associate($object)->save();

        return $record;
    }

    public static function withOrigin(?Model $origin, ?Model $object, ?string $action = null, ?string $comment = null):void
    {
        $record = self::add($object, $action, $comment);

        if($record)
            $record->origin()->associate($origin)->save();
    }
}
