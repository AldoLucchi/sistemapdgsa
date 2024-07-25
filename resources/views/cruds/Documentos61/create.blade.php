<x-default-layout>
    @section('title')
    <a href="{{ url('/'. (Session::has('Documentos61')?Session::get('Documentos61'):'admin/documento') ) }}">
        Documentos
    </a>
    @endsection

    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1">
                    CREAR
                </div>
                <!--end::Search-->
            </div>
            <!--begin::Card title-->

            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-Documentos61-table-toolbar="base">
                    <!--begin::Add Documentos61-->

                    <!--end::Add Documentos61-->
                </div>
                <!--end::Toolbar-->

                <!--begin::Modal-->
                <!--end::Modal-->
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->

        <!--begin::Card body-->
        <div class="card-body py-4">
            <!--begin::Table-->
            <form id="add_Documentos61_form" name="add_Documentos61_form" class="form" action="{{ route('admin.documento.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    @include('cruds.Documentos61.fields')
                </div>
                <div class="row">
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">
                            Crear
                        </button>
                    </div>
                </div>

            </form>
            <!--end::Table-->
        </div>
        <!--end::Card body-->
    </div>

    @push('scripts')
    <script>

    </script>
    @endpush

</x-default-layout>