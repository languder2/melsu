<?php

namespace App\Models\Page;

use App\Models\Contact;
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

}
