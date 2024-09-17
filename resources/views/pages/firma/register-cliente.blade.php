<x-public-layout>
    @section('title')
    Registrar Firma
    @endsection

    @include('pages.firma.siganture-pad-css')

    <div class="card w-100" id="cardIntroFirma">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6 text-center justify-content-center">
            <!--begin::Card title-->
            <div class="card-title text-center">
                <h3>Registrar firma en PDGSA</h3>
            </div>
            <!--begin::Card title-->

            <!--begin::Card toolbar-->
            <div class="card-toolbar">
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body py-4 text-center">
            {!! $intro !!}
        </div>
        <!--end::Card body-->
        <!--begin::Card footer-->
        <div class="card-footer py-4 text-center">
            <button type="button" class="btn btn-primary" id="aceptarFirma" name="aceptarFirma">Aceptar</button>
        </div>
        <!--end::Card footer-->
    </div>
    <div class="card w-100 d-none" id="cardRegistrarFirma">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6 text-center justify-content-center">
            <!--begin::Card title-->
            <div class="card-title ">
                Registrar firma
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
            <div class="row mt-5">
                <div class="mb-10 col-12 text-center">
                    @foreach($registerColumns as $colum)
                    @if($loop->iteration == 2)
                    @php
                    $nameColumn=$colum->Field;
                    @endphp

                    <h3>{{ $register->$nameColumn }} </h3>
                    @endif
                    @endforeach
                </div>
            </div>

            <div class="row">
                <div class="col-12 text-center justify-content-center">
                    <div id="signature-pad" class="signature-pad">
                        <div class="signature-pad--body">
                            <canvas></canvas>
                        </div>
                        <div class="signature-pad--footer">
                            <div class="description">firma</div>

                            <div class="signature-pad--actions">
                                <div>
                                    <button type="button" class="button clear" data-action="clear">Borrar</button>
                                    <button type="button" class="button" data-action="undo">Deshacer</button>
                                </div>
                                <div>
                                </div>
                            </div>

                            <form name="registrarFirma" id="registrarFirma" action="{{ url('/registrarFirmaGenerada') }}" method="POST" enctype="multipart/form-data" onsubmit="return savePng()">
                                @csrf
                                <input type="hidden" name="firma" id="firma">
                                <input type="hidden" name="table" id="table" value="{{ $table }}">
                                <input type="hidden" name="idRegister" id="idRegister" value="{{ $idRegister }}">
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <button type="submit" class="btn btn-primary w-50 ">
                                            Registrar Firma
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <!--end::Card body-->
    </div>

    @push('scripts')
    <script>
        $('#cardIntroFirma').on("click", function() {
            $('#cardIntroFirma').addClass('d-none');
            $('#cardRegistrarFirma').removeClass('d-none');
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.7/dist/signature_pad.umd.min.js"></script>
    @include('pages.firma.signature-pad-js')
    @include('pages.firma.app-js')
    @endpush

</x-public-layout>