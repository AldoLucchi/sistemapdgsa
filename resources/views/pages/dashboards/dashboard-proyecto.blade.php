<x-default-layout>

    @section('title')
    Dashboard
    @endsection

    @section('breadcrumbs')
    {{ Breadcrumbs::render('dashboard') }}
    @endsection

    <!--begin::Row-->
    <div class="row g-5 g-xl-10 mb-5 mb-xl-10 mb-5">
        <h2>Proyecto: {{ $proyecto->nombre }}</h2>
        <image src="/images/{{ $proyecto->logo }}" style="width:100px;">
    </div>
    <!--end::Row-->

    
</x-default-layout>