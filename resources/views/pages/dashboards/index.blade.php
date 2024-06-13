<x-default-layout>

    @section('title')
    Dashboard
    @endsection

    @section('breadcrumbs')
    {{ Breadcrumbs::render('dashboard') }}
    @endsection

    <!--begin::Row-->
    <div class="row g-5 g-xl-10 mb-5 mb-xl-10 mb-5">
        <h2>Proyectos Asociados:</h2>
        @if(Session::has('usuario_proyectos'))
        @foreach(Session::get('usuario_proyectos') as $proyecto)
        <div class="col-12 col-lg-3 mb-md-5 mb-xl-10">
            <a href="{{ url('/proyecto/'.$proyecto->idproyecto) }}" class="btn btn-primary p-5"><image src="/images/{{ $proyecto->logo }}" style="width:100px"> {{ $proyecto->nombre }}</a>
        </div>
        @endforeach
        @endif
    </div>
    <!--end::Row-->

    
</x-default-layout>