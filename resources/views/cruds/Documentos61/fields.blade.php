<div class="mb-10 col-12 col-lg-6">
    <label for="iddocumento" class="form-label">iddocumento</label>

    <input type="number" name="iddocumento" id="iddocumento" class="form-control form-control-solid" placeholder="iddocumento" value="{{ ( isset($Documentos61)?$Documentos61->iddocumento:"") }}" readonly />
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="nombre" class="form-label">nombre</label>

    <input type="text" name="nombre" id="nombre" class="form-control form-control-solid" placeholder="nombre" value="{{ ( isset($Documentos61)?$Documentos61->nombre:"") }}" />
</div>
<div class="mb-10 col-12 ">
    <label for="documento" class="form-label">
        documento
        |
        @if ( isset($Documentos61) )
        <a href="/docs/Documentos61_{{ $Documentos61->iddocumento }}.pdf" target="_blank">link</a>
        @endif
    </label>
    </label>
    <textarea id="documento" name="documento" class="tox-target">
    {{ ( isset($Documentos61)?$Documentos61->documento:"") }}
    </textarea>

    <script src="/assets/plugins/custom/tinymce/tinymce.js"></script>

    <script>
        var options = {
            selector: "#documento",
            height: "480",
            width: "100%",
            toolbar: ["styleselect fontselect fontsizeselect",
                "undo redo | cut copy paste | bold italic | link image | alignleft aligncenter alignright alignjustify",
                "bullist numlist | outdent indent | blockquote subscript superscript | advlist | autolink | lists charmap | preview | code | etiquetasDocumento"
            ],
            plugins: ["advlist", "autolink", "link", "image", "lists", "charmap", "preview", "code"],

            setup: (editor) => {
                /* Menu items are recreated when the menu is closed and opened, so we need
                   a variable to store the toggle menu item state. */
                let toggleState = false;

                /* example, adding a toolbar menu button */
                editor.ui.registry.addMenuButton('etiquetasDocumento', {
                    text: 'Etiquetas Documento',
                    fetch: (callback) => {
                        const items = [
                            @foreach($etiquetasDocumentos as $etiquetaDocumento) {
                                type: 'menuitem',
                                text: '{{ $etiquetaDocumento->alias }}',
                                onAction: () => editor.insertContent('%{{ $etiquetaDocumento->alias }}%')
                            },
                            @endforeach
                        ];
                        callback(items);
                    }
                });
            },
        };

        tinymce.init(options);
    </script>
</div>
<div class="mb-10 col-12 col-lg-6">    
    <label for="tabla" class="form-label">tabla</label>    
    <select name="tabla" id="tabla" class="form-select mb-3 mb-lg-0" placeholder="tabla">
    <option value="">-</option>
    @foreach($tablesDatabase as $table)
    <option value="{{ $table }}" {{ (isset($Documentos61) && $Documentos61->tabla == $table ?'selected':'' ) }}>{{ $table }}</option>
    @endforeach
    </select>
</div>