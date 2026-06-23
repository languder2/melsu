<?php

use Livewire\Volt\Component;
use Livewire\Attributes\On;
use App\Models\Education\Profile;
use App\Models\Education\Speciality;
use App\Enums\EducationForm;

new class extends Component {

    public ?Profile $profile = null;
    public ?Speciality $speciality = null;
    public EducationForm $form;
    public ?int $price = null;
    public ?int $years = null;
    public ?int $months = null;
    public ?string $address = null;

    public bool $show = true;
    public bool $is_recruitment = false;
    public bool $afc = false;

    public array $places = [];

    public ?int $places_budget = null;
    public ?int $places_contract = null;

    public function mount(Speciality $speciality, EducationForm $form): void
    {
        $this->form = $form;
        $this->speciality = $speciality;

        $this->profile = $this->speciality->profiles()->firstOrNew([
            'form' => $this->form->value ?? $this->form
        ]);

        $this->address          = $this->profile->address;

        $this->years            = intdiv($this->profile->duration ?? 0, 12);
        $this->months           = ($this->profile->duration ?? 0) % 12;

        $this->price            = $this->profile->price;

        $this->show             = $this->profile->show ?? true;
        $this->is_recruitment   = $this->profile->is_recruitment ?? false;
        $this->afc              = $this->profile->afc ?? false;

        $this->places           = [
            'budget' => $this->profile->placesByType('budget')->count,
            'contract' => $this->profile->placesByType('contract')->count,
        ];
    }

    public function rules(): array
    {
        return [
            'address'           => 'nullable|string',
            'years'             => 'nullable|integer',
            'months'            => 'nullable|integer',
            'price'             => 'nullable|integer',
            'show'              => 'required|boolean',
            'is_recruitment'    => 'required|boolean',
            'afc'               => 'required|boolean',
            'places.budget'     => 'nullable|integer',
            'places.contract'   => 'nullable|integer',
        ];
    }

    #[On('save-profile')]
    public function saveProfile($specialityId = null): void
    {
        $speciality = Speciality::find($specialityId);

        if (!$speciality) return;

        $profile = $speciality->profiles()->firstOrNew([
            'form' => $this->form->value ?? $this->form
        ]);

        $validated = $this->validate();

        $validated['duration'] = (($validated['years'] ?? 0) * 12) + ($validated['months'] ?? 0);

        $profile->fill($validated);

        if ($profile->isDirty())
            $profile->save();

        $profile->setAllPlaces($validated['places']);

        $this->dispatch('profile-saved');
    }
};
?>

<div x-show="activeTab === '{{ $form->name }}'" class="grid grid-cols-2 gap-3">

    <x-html.inputs.input
        label="Стоимость обучения обучения, рублей"
        name="price"
        min="0"
        max="10000000"
        type="number"
        placeholder="100000"
    />

    <div class="grid grid-cols-2 gap-3">
        <x-html.inputs.input
            label="Длительность обучения, годы"
            name="years"
            min="0"
            max="6"
            type="number"
            placeholder="4"
        />
        <x-html.inputs.input
            label="Длительность обучения, месяцы"
            name="months"
            min="0"
            max="12"
            type="number"
            placeholder="0"
        />
    </div>

    <x-html.inputs.input
        label="Адрес"
        name="address"
        placeholder="г. Мелитополь, ул. Бейбулатова 2"
        wrapper-class="col-span-full"
    />


    <div class="grid grid-cols-3 gap-3 col-span-full">
        <x-html.inputs.checkbox
            label="Опубликовать на сайте"
            name="show"
        />

        <x-html.inputs.checkbox
            label="Ведется прием"
            name="is_recruitment"
        />

        <x-html.inputs.checkbox
            label="Ведется прием иностранных граждан"
            name="afc"
        />
    </div>

    <x-html.inputs.input
        label="Кол-во мест на бюджете"
        name="places.budget"
        type="number"
        min="0"
        max="100"
        placeholder="0"
    />

    <x-html.inputs.input
        label="Кол-во мест на контракте"
        name="places.contract"
        type="number"
        min="0"
        max="100"
        placeholder="0"
    />

</div>
