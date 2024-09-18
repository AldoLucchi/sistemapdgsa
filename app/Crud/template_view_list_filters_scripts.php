<script>      

$(document).on('click', '.td_row', function() {
        var trrow = $(this).parent().attr('id');
        var id = trrow.replace('idrow_', '');
        var redirect = "{{ url('/'.(Session::has('%OBJETO_ROUTE%')?Session::get('%OBJETO_ROUTE%'):'crud/%OBJETO_ROUTE%') ) }}" + "/" + id + "/edit";

        @if(isset($row_url_custom) && $row_url_custom )
        var redirect = "{{ $row_url_custom }}"+ id
        @endif

        window.location.href = redirect;
    });
    
const texto = document.getElementById("texto");
texto.addEventListener("keypress", function(event) {
    if (event.key === "Enter") {
        event.preventDefault();
        redirectFiltros();
    }
});
        
%VIEW_LIST_FILTROS_JAVASCRIPT_ENTER%

//filtros
function redirectFiltros() {
    var urlFilter = "{{ url('/'.(Session::has('%OBJETO_ROUTE%')?Session::get('%OBJETO_ROUTE%'):'crud/%OBJETO_ROUTE%') ) }}"+"?";
                
    urlFilter = urlFilter+ "texto="+texto.value+"&";
    
    %VIEW_LIST_FILTROS_JAVASCRIPT%

    window.location.href = urlFilter;
}
</script>