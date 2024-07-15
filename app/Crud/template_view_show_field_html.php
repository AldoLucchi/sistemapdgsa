<div class="mb-10 col-12 ">
<label for="%FIELD%" class="form-label">%FIELD_ALIAS%</label>
<textarea id="%FIELD%" name="%FIELD%" class="tox-target">
{{ %FIELD_VALUE_SHOW% }}
</textarea>

<script src="/assets/plugins/custom/tinymce/tinymce.js"></script>

<script>
var options = {
    selector: "#%FIELD%", 
    height : "480", 
    width : "100%",
    toolbar: ["styleselect fontselect fontsizeselect",
        "undo redo | cut copy paste | bold italic | link image | alignleft aligncenter alignright alignjustify",
        "bullist numlist | outdent indent | blockquote subscript superscript | advlist | autolink | lists charmap | preview |  code"],           
    //plugins : ["advlist", "autolink", "link", "image", "lists", "charmap", "preview", "code"],    
};
//plugins : "advlist autolink link image lists charmap preview code"

tinymce.init(options);
</script>
</div>