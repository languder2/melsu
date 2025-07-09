@extends("layouts.info")

@section('title', 'ФГБОУ ВО "МелГУ"')

@section('breadcrumbs')

@endsection

@section('content-header')
    {{ __('info.education.title') }}
@endsection

@section('content')

    @component('components.info.education.education-list', $education->eduAccred())@endcomponent

    @component('components.info.documents', $education->getTemplate('languageEl','documents') )@endcomponent

    @component('components.info.documents', $education->getTemplate('eduChislenEl','documents') )@endcomponent

    @component('components.info.documents', $education->getTemplate('eduPriemEl','documents') )@endcomponent

    @component('components.info.documents', $education->getTemplate('eduPerevodEl','documents') )@endcomponent

    @component('components.info.education-eduOp', $education->eduOp())@endcomponent

    @component('components.info.education-eduOp', $education->eduAdOp())@endcomponent

    @component('components.info.education-eduNir', $education->eduNir())@endcomponent

    @component('components.info.education-graduateJob', $education->graduateJob())@endcomponent

@endsection


