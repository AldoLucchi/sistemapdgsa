<script>      

$(document).on('click', '.td_row', function() {
        var trrow = $(this).parent().attr('id');
        var id = trrow.replace('idrow_', '');
        var redirect = "";
        
        if(%OBJETO_UPDATE_CHECK%){
            redirect = "{{ url('/'.(Session::has('%OBJETO_ROUTE%')?Session::get('%OBJETO_ROUTE%'):'crud/%OBJETO_ROUTE%') ) }}" + "/" + id + "/edit";
        }
        else if(%OBJETO_READ_CHECK%){
            redirect = "{{ url('/'.(Session::has('%OBJETO_ROUTE%')?Session::get('%OBJETO_ROUTE%'):'crud/%OBJETO_ROUTE%') ) }}" + "/" + id ;
        }

        @if(isset($row_url_custom) && $row_url_custom )
        var redirect = "{{ $row_url_custom }}"+ id
        @endif

        if(redirect ){
        window.location.href = redirect;
        }
        else{
            $('.td_row').css("cursor", "default");
        }
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