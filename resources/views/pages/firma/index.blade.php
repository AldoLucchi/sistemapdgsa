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
            <form name="getDataFirma" action="{{ url('/admin/getDataFirma') }}">
                @csrf
                <div class="row">
                    <div class="mb-10 col-12 col-lg-6">
                        <label for="estatus" class="form-label">Seleccione la tabla para guardar la firma</label>
                        <select class="form-select" name="table" onchange="showRegisters()">
                            <option value="">---</option>
                            @foreach($tables as $tableItem)
                            <option value="{{ $tableItem }}" {{ (isset($table) && $tableItem == $table)?'selected':'' }}> {{ $tableItem }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-10 col-12 col-lg-6">
                        <label for="estatus" class="form-label">Ingrese el ID del registro </label>
                        <input type="text" name="idRegister" class="form-control" value="{{ isset($idRegister)?$idRegister:'' }}">
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Buscar
                    </button>

                </div>
            </form>

            @if( isset($register) )

            <div class="row mt-5">
                <div class="mb-10 col-12 col-lg-6">
                    <h3>Detalle</h3>
                    <table>
                        @foreach($registerColumns as $colum)

                        @if($loop->iteration < 4)
                        @php
                        $nameColumn = $colum->Field;
                        @endphp
                        <tr>
                            <td>{{ $nameColumn  }}</td>
                            <td>{{ $register->$nameColumn }} </td>
                        </tr>
                        @endif
                        @endforeach
                    </table>
                
                    <a href="{{ url('/registrarFirma/'.$table.'/'.$idRegister ) }}" class="btn btn-success mt-5">
                        Registrar firma
                    </a>
                </div>
            </div>
            @endif
        </div>
        <!--end::Card body-->
    </div>

    @push('scripts')
    <script>

    </script>
    @endpush

</x-default-layout>