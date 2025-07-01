@extends("layouts.info")

@section('title', 'ФГБОУ ВО "МелГУ"')

@section('breadcrumbs')

@endsection

@section('content-header')
    {{ __('info.budget.title') }}
@endsection

@section('content')

    @component('components.info.table', $budget->template('current'))
        @slot('caption')
            Объем образовательной деятельности, финансовое обеспечение которой осуществляется
        @endslot
    @endcomponent

    @component('components.info.table', $budget->template('volume'))@endcomponent

    @component('components.info.documents', $budget->getTemplate('finPlanDocLink','documents'))@endcomponent

@endsection


