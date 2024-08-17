<script>
        const %SELECT_CAMPO_ANIDADO%Element = document.getElementById("%SELECT_CAMPO_ANIDADO%");

        %SELECT_CAMPO_ANIDADO%Element.addEventListener("load", (event) => {                    
                console.log("load - %SELECT_CAMPO_ANIDADO%Options" );
                %SELECT_CAMPO_ANIDADO%Options();  
        });

        %SELECT_CAMPO_ANIDADO%Element.addEventListener("change", (event) => {                    
                console.log("change - %SELECT_CAMPO_ANIDADO%Options" );
                %SELECT_CAMPO_ANIDADO%Options();  
        });

        function %SELECT_CAMPO_ANIDADO%Options(){
            console.log("%SELECT_CAMPO_ANIDADO%Element --- " + %SELECT_CAMPO_ANIDADO%Element.value);

            Array.from(document.querySelector("#%SELECT_NAME%").options).forEach(function(option_element) {
                option_element.style.display = "block";
                //let option_value = option_element.value;
                let option_%SELECT_CAMPO_ANIDADO% = option_element.getAttribute("%SELECT_CAMPO_ANIDADO%");  

                if (option_%SELECT_CAMPO_ANIDADO% != %SELECT_CAMPO_ANIDADO%Element.value) {
                    option_element.style.display = "none";
                }
            });
        }
</script>