<?php

namespace App\Models\Upbringing;

use App\Models\Gallery\Gallery;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Upbringing extends Model
{
    protected $table = 'upbringing_sections';

    protected $fillable = [
        'title', 'show_title', 'code', 'component', 'content',
        'relation_id', 'relation_type', 'show', 'order'
    ];

    protected $casts = [
        'show_title' => 'boolean',
        'show' => 'boolean',
    ];

    public function relation(): MorphTo
    {
        return $this->morphTo();
    }
    public function getContentAttribute($value)
    {
        $pattern = '/image-gallery:([a-zA-Z0-9-]+):end-gallery/';


        if (preg_match($pattern, $value, $matches)) {

            $code= $matches[1];

            $gallery = Gallery::where('code',$code)->first();

            return str_replace(
                "image-gallery:$code:end-gallery",
                $gallery ? view('gallery.images.public.includes.gallery',compact('gallery')) : null,
                $value
            );
        }
        else
            return $value;
    }

}
