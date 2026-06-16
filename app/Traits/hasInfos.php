<?php

namespace App\Traits;

use App\Models\Info\Info;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait hasInfos
{
    public function infos(): MorphMany
    {
        return $this->morphMany(Info::class, 'relation');
    }
    public function info(): MorphOne
    {
        return $this->morphMany(Info::class,'relation');
    }
    public function getInfoByCode($code): Info
    {
        return $this->infos()->firstOrNew('code',$code);
    }
    public function getInfoValueByCode($code): ?string
    {
        return $this->infos()->firstOrNew(['code' => $code])->content;
    }
}
