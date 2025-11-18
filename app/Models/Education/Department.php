<?php

namespace App\Models\Education;

use App\Models\Division\Division;
use App\Models\Gallery\Image;
use App\Models\Minor\Contact;
use App\Models\Page\Content as PageContent;
use App\Models\Staff\Affiliation as StaffAffiliation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use SoftDeletes;

    protected $table = 'education_departments';

    protected $fillable = [
        'id',
        'name',
        'code',
        'identity_id',
        'faculty_code',
        'description',
        'order',
    ];

    public static function FormRules($id): array
    {
        return [
            'name' => 'required',
            'code' => "required|unique:education_departments,code,{$id},id,deleted_at,NULL",
            'faculty_code' => '',
            'description' => '',
            'order' => 'nullable|numeric',
        ];
    }

    public static function FormMessage(): array
    {
        return [
            'name' => 'Укажите заголовок',
            'code.required' => 'Код должен быть указан',
            'code.unique' => 'Код должен быть уникальным',
            'faculty.required' => 'Укажите факультет',
        ];
    }

    public function faculty(): BelongsTo
    {
        return $this->belongsTo(Faculty::class, 'faculty_code', 'code');
    }

    public function getOrderAttribute(?int $value): int|null
    {
        return ($value < 10000) ? $value : null;
    }

    public function setOrderAttribute(?int $value): void
    {
        $this->attributes['order'] = $order ?? 10000;
    }

    public function specialities(): HasMany
    {
        return $this->hasMany(Speciality::class, 'department_code', 'code');
    }

    public function getLinkAttribute(): string
    {
        return route('public:education:department',[
            $this->faculty->code ?? $this->faculty->id ?? null,
            $this->code ?? $this->id ?? null,
        ]);
    }

    public function labs(): MorphMany
    {
        return $this->morphMany(Lab::class, 'relation');
    }

    public function sections(): MorphMany
    {
        return $this->morphMany(PageContent::class, 'relation');
    }

    public function contacts(?string $type = null): MorphMany
    {
        $query = $this->morphMany(Contact::class, 'relation');

        if($type)
            $query->where('type', $type);

        return $query->orderBy('type')->orderBy('sort');
    }
    public function staffs($all= false): MorphMany
    {
        $response = $this->morphMany(StaffAffiliation::class, 'relation')->orderBy('order');

        if(!$all)
            $response = $response->where('type','staff');

        return $response;
    }

    public function preview(): MorphOne
    {

        $image = $this->MorphOne(Image::class, 'relation')->where('type', 'logo');

        if(!$this->id)
            return $image;

        if(!$image->count())
            $image->create([
                'type'      => 'logo',
                'name'      => 'preview',
            ]);

        return $image;
    }

    public function division(): MorphOne
    {

        $item = $this->MorphOne(Division::class, 'relation');

        if(!$this->id)
            return $item;

        if(!$item)
            $item = New Division();

        return $item;
    }



}
