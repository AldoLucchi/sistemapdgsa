<x-default-layout>
    @section('title')
    Registrar Firma
    @endsection

    @include('pages.firma.siganture-pad-css')

    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
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
                <div class="mb-10 col-12 col-lg-6">
                    <h3>Detalle</h3>
                    <table>
                        @foreach($registerColumns as $colum)

                        @if($loop->iteration < 5) @php $nameColumn=$colum->Field;
                            @endphp
                            <tr>
                                <td>{{ $nameColumn  }}</td>
                                <td>{{ $register->$nameColumn }} </td>
                            </tr>
                            @endif
                            @endforeach
                    </table>
                </div>
            </div>


            <form name="registrarFirma" action="{{ url('/admin/registrarFirma') }}">
                @csrf
                <div class="row">
                    <div class="col-12 text-center">


                        <div id="signature-pad" class="signature-pad">
                            <div class="signature-pad--body" >
                                <canvas width="640" height="480"></canvas>
                            </div>
                            <div class="signature-pad--footer">
                                <div class="description">Sign above</div>

                                <div class="signature-pad--actions">
                                    <div>
                                        <button type="button" class="button clear" data-action="clear">Clear</button>
                                        <button type="button" class="button" data-action="change-color">Change color</button>
                                        <button type="button" class="button" data-action="undo">Undo</button>

                                    </div>
                                    <div>
                                        <button type="button" class="button save" data-action="save-png">Save as PNG</button>
                                        <button type="button" class="button save" data-action="save-jpg">Save as JPG</button>
                                        <button type="button" class="button save" data-action="save-svg">Save as SVG</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary w-50">
                            Guardar
                        </button>
                    </div>
                </div>
            </form>


        </div>
        <!--end::Card body-->
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.7/dist/signature_pad.umd.min.js"></script>
    @include('pages.firma.signature-pad-js')
    @include('pages.firma.app-js')
    @endpush

</x-default-layout>