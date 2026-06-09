<?php

use Livewire\Volt\Component;
use Livewire\Attributes\On;
use App\Models\Education\Profile;
use App\Models\Education\Speciality;

new class extends Component {

    public ?Profile $profile;
    public ?Speciality $speciality;

    public ?string $type = null;

    public ?int $specialityID = null;

//    public function mount($profile): void
//    {
//        if(is_null($profile)){
//            $this->profile = new Profile();
//            $this->profile->speciality_id = 154;
//        }
//
//    }
//
//    public function with(): array
//    {
//
//        return [
//
//        ];
//    }
//
    #[On('save-profile')]
    public function saveProfile(): void
    {
        $this->js('alert(1)');

        dd($this->specialityID);
        dump(1);
    }
};



?>

<div x-show="activeTab === '{{ $type }}'">
    @dump($type)
    @dump($speciality)
</div>
