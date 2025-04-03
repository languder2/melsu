<?php

namespace App\Models\Handbook;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HandbookModel extends Model
{
    use HasFactory;

    protected $fillable = ['handbook_collection_id', 'title', 'link', 'icon', 'color', 'category'];

    public function collection()
    {
        return $this->belongsTo(HandbookCollectionModel::class, 'handbook_collection_id');
    }
}
