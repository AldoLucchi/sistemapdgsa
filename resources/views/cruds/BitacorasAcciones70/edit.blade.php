<x-default-layout>
    @section('title')
    <a href="{{ url('/admin/bitacoraAccion')  }}">
        Bitácora Acciones
    </a>
    @endsection

    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1">
                    EDITAR
                </div>
                <!--end::Search-->
            </div>
            <!--begin::Card title-->

            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-BitacorasAcciones70-table-toolbar="base">
                    <!--begin::Add BitacorasAcciones70-->
                    @foreach($documentos as $key=> $documento)
                    <a href="{{ url($documento.$BitacorasAcciones70->idaccion ) }}" class="btn btn-secondary mx-5" target="_blank">
                        Pdf: {{ $key }}
                    </a>
                    @endforeach
                    <!--end::Add BitacorasAcciones70-->
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

            <form id="edit_BitacorasAcciones70_form" name="edit_BitacorasAcciones70_form" class="form" action="{{ route('admin.bitacoraAccion.update', $BitacorasAcciones70) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    @include('cruds.BitacorasAcciones70.fields')
                </div>

                <div class="row">
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">
                            Guardar
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