        //campo dependiente oculto ----------------
        const %CAMPO_SELECT_OCULTO%OcultoElement = document.getElementById("%CAMPO_SELECT_OCULTO%");

        window.addEventListener("load", (event) => {
                console.log("load - %CAMPO_SELECT_OCULTO%OcultoOptions");
                %CAMPO_SELECT_OCULTO%OcultoOptions();
        });

        %CAMPO_SELECT_OCULTO%OcultoElement.addEventListener("change", (event) => {
                console.log("change - %CAMPO_SELECT_OCULTO%OcultoOptions");
                %CAMPO_SELECT_OCULTO%OcultoOptions();
        });

        function %CAMPO_SELECT_OCULTO%OcultoOptions() {
                console.log("%CAMPO_SELECT_OCULTO%OcultoElement --- " + %CAMPO_SELECT_OCULTO%OcultoElement.value);
                %CAMPOS_DEPENDIENTES_OCULTO_VAR%

                %CAMPOS_DEPENDIENTES_OCULTO_NONE%

                %CAMPOS_DEPENDIENTES_OCULTO_IF%
        }