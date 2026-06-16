<?php

use Livewire\Volt\Component;
use App\Models\Info\InfoEducation;
use App\Models\Info\InfoDocuments;
use App\Enums\Info\Education;
use Livewire\Attributes\Layout;


new #[Layout('layouts.info')] class extends Component {

    public function with(): array
    {
        return [
            'model' => new InfoEducation(),
            'documents' => new InfoDocuments(),
            'sections'  => [
                Education::eduAccred,
                Education::languageEl,
                Education::eduChislenEl,
                Education::eduPriemEl,
                Education::eduPerevodEl,
                Education::eduOp,
                Education::eduNir,
                Education::graduateJob,
            ]
        ];
    }
};
?>

<div>
    <h3 class="content-header text-2xl font-semibold py-3">
        Образование
    </h3>

    <ul class="list-disc ps-5" >
        @foreach($sections as $section)
            <li>
                <a href="#{{ $section->name }}"
                   class="text-blue-600 hover:text-red-600 hover:underline whitespace-nowrap"
                >
                    {{ $section->getName() }}
                </a>
            </li>
        @endforeach
    </ul>

    <div class="flex flex-col gap-3">
        @component('components.info.documents', $documents->getTemplate('accreditationDocLink','documents'))@endcomponent

        <livewire:sveden.education.eduAccred />

        @component('components.info.documents', $model->getTemplate('languageEl','documents') )@endcomponent
        @component('components.info.documents', $model->getTemplate('eduChislenEl','documents') )@endcomponent
        @component('components.info.documents', $model->getTemplate('eduPriemEl','documents') )@endcomponent
        @component('components.info.documents', $model->getTemplate('eduPerevodEl','documents') )@endcomponent

        <livewire:sveden.education.eduOp />

        <livewire:sveden.education.eduNir />

        <livewire:sveden.education.graduateJob />
    </div>
</div>
