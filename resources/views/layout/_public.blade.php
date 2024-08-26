@extends('layout.master')

@section('content')

    <!--begin::App-->
    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <!--begin::Wrapper-->
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <!--begin::Body-->
            <div class="d-flex flex-column flex-lg-row-fluid  p-10 order-2 order-lg-1">
                <!--begin::Form-->
                <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                    <!--begin::Wrapper-->
                    <div class="w-100 p-10">
                        <!--begin::Page-->
                        {{ $slot }}
                        <!--end::Page-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Form-->

                <!--begin::Footer-->
                <div class="d-flex flex-center flex-wrap px-5">
                    <!--begin::Links-->
                    <div class="d-flex fw-semibold text-primary fs-base">
                        <span href="javascript;" class="px-5" target="_blank" style="cursor:unset !important; color: #E55929 !important">Inicio</span>|

                        <span href="javascript;" class="px-5" target="_blank" style="cursor:unset !important; color: #E55929 !important">Aula Virtual</span>|

                        <span href="javascript;" class="px-5" target="_blank" style="cursor:unset !important; color: #E55929 !important">Soporte</span>
                        <br>
                    </div>
                    <!--end::Links-->
                </div>
                <!--end::Footer-->
            </div>
            <!--end::Body-->

            
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::App-->

@endsection
