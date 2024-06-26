<x-default-layout>

    @section('title')
    Dashboard
    @endsection

    @section('breadcrumbs')
    {{ Breadcrumbs::render('dashboard') }}
    @endsection

    <style>
        .centered-element {
            margin: 0;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
        }

        .card-dashboard {
            width: 300px;
            vertical-align: middle;
            min-width: 300px;
        }

        .card-dashboard-link {
            display: flex;
            /*justify-content: center;*/
            align-items: center;
        }

        .card-dashboard-image {
            width: 100px;
            height: 100px;
            float: left;
            margin-right: 10px;

        }

        .card-dashboard-label {
            width: 100px;
            display: contents;
            vertical-align: middle;
        }
    </style>

    <!--begin::Row-->
    <div class="row g-5 g-xl-10 mb-5 mb-xl-10 mb-5">
        <h2>Proyectos Asociados:</h2>
        @if(Session::has('usuario_proyectos'))
        @foreach(Session::get('usuario_proyectos') as $proyecto)
        <div class="col-12 col-lg-3 mb-md-5 mb-xl-10 card-dashboard ">
            <a href="{{ url('/proyecto/'.$proyecto->idproyecto) }}" class="btn btn-primary p-5 card-dashboard-link">
                <image src="/images/{{ $proyecto->logo }}" class="card-dashboard-image">
                    <label class="card-dashboard-label">{{ $proyecto->nombre }} </label>
            </a>
        </div>
        @endforeach
        @endif
    </div>
    <!--end::Row-->


</x-default-layout>