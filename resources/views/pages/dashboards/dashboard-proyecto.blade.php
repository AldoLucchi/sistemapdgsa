<x-default-layout>

    @section('title')
    Dashboard Proyecto
    @endsection


    <!--begin::Row-->
    <div class="row g-5 g-xl-10 mb-15">
        <div class="col-1">
            <image src="/images/{{ (isset($proyecto)?$proyecto->logo:'') }}" style="width:50px;">
        </div>
        <div class="col-11">
            <h2 class="mt-3"> {{ (isset($proyecto)?$proyecto->nombre:'--') }}</h2>
        </div>
    </div>
    <!--end::Row-->
    <!--begin::Row-->
    <div class="row g-5 g-xl-10 mb-5 mb-xl-10 mb-5">

        @if(Session::has('menues'))
        @foreach( Session::get('menues') as $menu)

        <!--begin:Menu item-->
        <div class="row">
            <!--begin:Menu link-->
            <div class="row bg-gray-300 py-3">
                <div class="col-1 text-end ">
                    <span class="menu-icon">{!! getIcon($menu['icono'], 'fs-2') !!}</span>
                </div>
                <div class="col-11">
                    <h3 class="text-uppercase">{{ $menu['nombre'] }}</h3>
                </div>
            </div>
            <!--end:Menu link-->
            <!--begin:Menu sub-->
            <div class="row">

                @foreach($menu['items'] as $item)
                <!--begin:Menu item-->
                <div class="col-3 py-5" >
                    <!--begin:Menu link-->
                    @if($item['tipo'] == 'crud')
                    <a class="menu-link {{ request()->routeIs($item['ruta'].'.*') ? 'active' : '' }}" href="{{ route($menu['ruta'].'.'.$item['ruta'].'.index') }}">
                        @else
                        <a class="menu-link {{ str_contains(request()->route()->getName(), $item['ruta_laravel'])  ? 'active' : '' }}" href="{{ $item['ruta'] }}">
                            @endif
                            
                            <span class="menu-title text-uppercase">{{ $item['nombre'] }}</span>
                        </a>
                        <!--end:Menu link-->
                </div>
                <!--end:Menu item-->
                @endforeach
            </div>
            <!--end:Menu sub-->
        </div>

        <!--end:Menu item-->

        @endforeach
        @endif

    </div>
    <!--end::Row-->

</x-default-layout>