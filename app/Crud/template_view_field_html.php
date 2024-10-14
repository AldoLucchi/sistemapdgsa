<div class="mb-10 col-12 " id="div_%FIELD%" style="%FIELD_HIDDEN%">
    <label for="%FIELD%" class="form-label">%FIELD_ALIAS%</label>%FIELD_REQUIRED_ICON%
    
    <textarea id="%FIELD%" name="%FIELD%" class="tox-target" %FIELD_READONLY% %FIELD_REQUIRED% %FIELD_DISABLED%>
    {!! %FIELD_VALUE_SHOW% !!}
    </textarea>
    <br>
    %FIELD_TEXT_HELP%

    <script src="/assets/plugins/custom/tinymce/tinymce.js"></script>

    <script>
        var options = {
            selector: "#%FIELD%",
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