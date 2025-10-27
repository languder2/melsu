<?php

namespace App\Models\Partners;

use App\Models\Gallery\Image;
use App\Traits\hasContents;
use App\Traits\hasImage;
use App\Traits\hasRelations;
use App\Traits\hasLinks;
use App\Traits\resolveRouteBinding;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Partner extends Model
{

    use SoftDeletes, hasLinks, hasRelations, hasImage, hasContents;

    protected array $links = [
        'form'      => 'partners.form',
        'save'      => 'test.save',
        'delete'    => 'test.delete',
        'admin'     => 'test.admin',
        'list'      => 'test.list',
        'single'    => 'test.single',
    ];


    protected $table = 'partners';

    protected $fillable = [
        'name',
        'is_show',
        'sort'
    ];

    protected $casts = [
        'show_title' => 'boolean',
        'show' => 'boolean',
    ];

    protected $dates = ['deleted_at'];

    public function getSaveAttribute(): string
    {
        return route('clusters.save', $this->exists ? $this->id : null);
    }

}
