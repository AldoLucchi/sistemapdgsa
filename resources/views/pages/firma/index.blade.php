<x-default-layout>

    @section('title')
    Firma
    @endsection



    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                Generar Link de firma
            </div>
            <!--begin::Card title-->

            <!--begin::Card toolbar-->
            <div class="card-toolbar">



            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->

        <!--begin::Card body-->
        <div class="card-body py-4">

            <div class="mb-10 col-12 col-lg-6">
                <label for="estatus" class="form-label">Seleccione la tabla para guardar la firma</label>
                <select class="form-select" onchange="showRegisters()">
                    <option value="">---</option>
                    @foreach($tables as $table)
                    <option value="{{ $table }}"> {{ $table }}</option>
                    @endforeach
                </select>
            </div>


            <div class="mb-10 col-12 col-lg-6">
                <label for="estatus" class="form-label">Seleccione el registro </label>

            </div>
        </div>
        <!--end::Card body-->
    </div>

    @push('scripts')
    <script>

        </script>
    @endpush

</x-default-layout>