<textarea id="%FIELD%" name="%FIELD%" class="tox-target">
</textarea>

<script>
var options = {selector: "#%FIELD%", height : "480", width : "100%"};

if ( KTThemeMode.getMode() === "dark" ) {
    options["skin"] = "oxide-dark";
    options["content_css"] = "dark";
}

tinymce.init(options);
</script>