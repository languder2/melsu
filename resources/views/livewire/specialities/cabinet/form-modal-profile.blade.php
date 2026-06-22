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

    public function mount(Speciality $speciality, EducationForm $form): void
    {
        $this->form = $form;
        $this->speciality = $speciality;

        $this->profile = $this->speciality->profiles()->firstOrNew([
            'form' => $this->form->value ?? $this->form
        ]);
    }

    #[On('save-profile')]
    public function saveProfile($specialityId =  null): void
    {

        $speciality = Speciality::find($specialityId);

        $profile = $speciality->profiles()->firstOrNew([
            'form' => $this->form->value ?? $this->form
        ]);

        $output = json_encode($profile);

        $this->js("console.log({$output})");

        $this->dispatch('test');
    }
};

?>

<div x-show="activeTab === '{{ $form->name }}'">
    @dump($form)
    @dump($profile)
</div>
