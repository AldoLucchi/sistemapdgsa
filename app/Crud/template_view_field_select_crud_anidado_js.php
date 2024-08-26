
//crud anidado-----------------------
const %SELECT_CAMPO_ANIDADO%CrudElement = document.getElementById("%SELECT_CAMPO_ANIDADO%");

window.addEventListener("load", (event) => {                    
        console.log("load - %SELECT_CAMPO_ANIDADO%CrudOptions" );
        %SELECT_CAMPO_ANIDADO%CrudOptions();  
});

%SELECT_CAMPO_ANIDADO%CrudElement.addEventListener("change", (event) => {                    
        console.log("change - %SELECT_CAMPO_ANIDADO%CrudOptions" );
        %SELECT_CAMPO_ANIDADO%CrudOptions();  
});

function %SELECT_CAMPO_ANIDADO%CrudOptions(){
        console.log("%SELECT_CAMPO_ANIDADO%CrudElement --- " + %SELECT_CAMPO_ANIDADO%CrudElement.value);
        
        %SELECT_CAMPO_VALIDATION%
}

%SELECT_DIV_BUTTON_ANIDADO%

