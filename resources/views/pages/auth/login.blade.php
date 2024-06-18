<x-auth-layout>

    <!--begin::Form-->
    <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" data-kt-redirect-url="{{ route('dashboard') }}" action="{{ route('login') }}" method="POST">
        @csrf
        <!--begin::Heading-->
        <div class="text-center mb-11">
            <!--begin::Title-->
            <h1 class="text-gray-900 fw-bolder mb-3" style="padding-right:3rem">
                VTC
            </h1>
            <!--end::Title-->

            <!--begin::Subtitle-->
            <div class="text-gray-500 fw-semibold fs-6">
                <span href="javascript;" class="px-5" target="_blank" style="cursor:unset !important;">Ventas</span>|
                <span href="javascript;" class="px-5" target="_blank" style="cursor:unset !important;">Tramites</span>|
                <span href="javascript;" class="px-5" target="_blank" style="cursor:unset !important;">Construcción</span>
            </div>
            <!--end::Subtitle--->
        </div>
        <!--begin::Heading-->

        <!--begin::Login options-->
        <div class="row g-3 mb-9">
            <!--begin::Col-->
            <div class="col-md-12">
                <!--begin::Google link--->
                <a href="{{ route('google.redirect') }}" class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100">
                    <img alt="Logo" src="{{ image('svg/brand-logos/google-icon.svg') }}" class="h-15px me-3"/>
                    Iniciar sesión con Google
                </a>
                <!--end::Google link--->               
            </div>
            <!--end::Col-->            
        </div>
        <!--end::Login options--> 

        <!--begin::Login options-->
        <div class="row g-3 mb-9">
            <!--begin::Col-->
            <div class="col-md-12">

            @if($errors->any())
            <div class="alert alert-danger text-center text-danger" role="alert">
            <b>*{{$errors->first()}}</b>
            </div>
            @endif
                
            </div>
            <!--end::Col-->            
        </div>
        <!--end::Login options--> 

        
    </form>
    <!--end::Form-->

</x-auth-layout>