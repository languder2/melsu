<?php

namespace App\Models\Page;

use App\Models\Gallery\Gallery;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Content extends Model
{
    use SoftDeletes;
    protected $table = 'page_contents';

    protected $fillable = [
        'title',
        'show_title',
        'content',
        'show',
        'order',
        'relation_type'
    ];

    public function relation(): MorphTo
    {
        return  $this->morphTo();
    }

    public static function processing($record,$forms)
    {
        foreach ($forms as $id=>$form) {
            $form['show']         = array_key_exists('show',$form);
            $form['show_title']   = array_key_exists('show_title',$form);

            unset($form['id']);

            $content = Content::find($id);
            if(!$content)
                $content  = new Content($form);

            $content->fill($form);

            $content->relation()->associate($record);

            $content->save();
        }
    }


    public function getContentAttribute($value)
    {
        $pattern = '/image-gallery:([a-zA-Z0-9-]+):end-gallery/';


        if (preg_match_all($pattern, $value, $matches)) {

            foreach ($matches[1] as $match)
                self::insertGallery($value,$match);
        }

        return $value;
    }

    public static function insertGallery(&$content, ?string $code):void
    {

        $gallery = Gallery::where('code',$code)->first();


        $content = str_replace(
            "image-gallery:$code:end-gallery",
            $gallery ? view('gallery.images.public.includes.gallery',compact('gallery')) : null,
            $content
        );
    }

    public function getTest()
    {
        $value = $this->getAttribute('content');
        $pattern = '/image-gallery:([a-zA-Z0-9-]+):end-gallery/';

        if (preg_match($pattern, $value, $matches)) {

            $code= $matches[1];

            $gallery = Gallery::where('code',$code)->first();

            return str_replace(
                "image-gallery:$code:end-gallery",
                $gallery ? view('gallery.images.pubic.includes.gallery',compact('gallery')) : null,
                $value
            );
        }
        else
            return $value;

    }



}
