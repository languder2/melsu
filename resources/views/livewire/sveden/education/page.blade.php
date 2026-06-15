<?php

use Livewire\Volt\Component;
use App\Models\Info\InfoEducation;

new class extends Component {

    public function rendering($view): void
    {
        $view->layout('layouts.info');
    }

    public function with(): array
    {
        return [
            'model' => new InfoEducation()
        ];
    }
};
?>

<div>
    <div class="content-header text-2xl font-semibold py-3">
        Образование
    </div>

    <livewire:sveden.education.list-1/>

    @component('components.info.documents', $model->getTemplate('languageEl','documents') )@endcomponent

    @component('components.info.documents', $model->getTemplate('eduChislenEl','documents') )@endcomponent

    @component('components.info.documents', $model->getTemplate('eduPriemEl','documents') )@endcomponent

    @component('components.info.documents', $model->getTemplate('eduPerevodEl','documents') )@endcomponent

    <livewire:sveden.education.list-3/>



</div>
