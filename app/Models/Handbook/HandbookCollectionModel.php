<?php

namespace App\Models\Handbook;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HandbookCollectionModel extends Model
{
    use HasFactory;

    protected $table = 'handbook_collections';

    protected $fillable = ['page_name'];

    public function handbooks()
    {
        return $this->hasMany(HandbookModel::class);
    }
}
