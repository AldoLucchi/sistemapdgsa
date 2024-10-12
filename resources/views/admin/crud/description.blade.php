<table class="table border border-primary text-start">
    <tr class="bg-primary">
        <td>
            Indice: se utiliza para configurar el orden del campo en los listados y formularios de los CRUD
        </td>
    </tr>
    <tr class="bg-primary">
        <td>
            Incluir campo: si ningún campo esta marcado para incluir, automáticamente se incluyen todos
        </td>
    </tr>
    <tr class="bg-primary">
        <td>
            Incluir list: si ningún campo esta marcado para incluir, automáticamente se incluyen todos
        </td>
    </tr>
    <tr class="bg-primary">
        <td>
            Alias: se utiliza para asignar un texto personalizado, en el label de un campo del CRUD
        </td>
    </tr>
    <tr class="bg-primary">
        <td>
            Texto ayuda: se utiliza para asignar un texto de ayuda, debajo del campo, en los formularios de un CRUD
        </td>
    </tr>
    <tr class="bg-primary">
        <td>
            Regex (validación): solo para campos de tipo: text, date, search, url, tel, email, and password. Ejemplos:
            <br>-validación de todos los caracteres en minúsuculas: ^[a-z][a-z0-9_.]*$
            <br>-validación solo letras: ^[a-zA-Z]*$
            <br>-validación para emails: ^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$
            <br>-validación para teléfono (9 dígitos): ^(\d{7})$

        </td>
    </tr>
    <tr class="bg-primary">
        <td>
            Maxlength (validación): se utiliza para limitar la cantidad de caracteres de un campo
        </td>
    </tr>
    <tr class="bg-primary">
        <td>
            Requerido (validación): se utiliza para configurar un campo como obligatorio
        </td>
    </tr>
    <tr class="bg-primary">
        <td>
            Readonly: se utiliza para configurar un campo como solo lectura
        </td>
    </tr>
    <tr class="bg-primary">
        <td>
            Hidden: se utiliza para ocultar campos de los form de creación / edición
        </td>
    </tr>
    <tr class="bg-success">
        <td>
            Seleccionar FK: se utiliza para configurar una tabla foranea asociada al campo. Esto permite desplegar un select con los valores de dicha tabla
        </td>
    </tr>
    <tr class="bg-success">
        <td>
            Style Color: se utiliza para estilizar valores de campos select los listados. Colores válidos: primary, secondary, success, info, warning, danger, dark, white, muted, gray-100 a gray-900. Por ejemplo: idestatus,=,1,success;idestatus,=2,danger;
        </td>
    </tr>
    <tr class="bg-danger">
        <td>
            Campos anidados FK: (requiere Seleccionar FK) permite seleccionar una dependencia con otro campo, y esto habilita un filtrado dinámico según el valor seleccionado del campo dependiente
        </td>
    </tr>
    <tr class="bg-danger">
        <td>
            Reglas SQL Select FK: (requiere Seleccionar FK) para setear una o más reglas de filtrado, en formato SQL
            <br>Nota: Usar comillas simples según corresponda
        </td>
    </tr>
    <tr class="bg-danger">
        <td>
            Reglas Select FK: (requiere Seleccionar FK) para setear una o más reglas de filtrado, el formato es el siguiente: campo,operador,valor;campo,operador,valor
            <br> Nota: si Reglas SQL Select FK esta seteado, esta validación queda obsoleta.
        </td>
    </tr>

    <tr class="bg-info">
        <td>
            Reglas CRUD anidado: (requiere Seleccionar FK) para setear una o más reglas de crud anidado, el formato es el siguiente: campo,operador,valor,idcrud,cantidadregistros;campo,operador,valor,idcrud,cantidadregistros
        </td>
    </tr>
    <tr class="bg-info">
        <td>
            Reglas campos dependientes ocultos: (requiere Seleccionar FK) para setear una o más reglas de campos dependientes ocultos, el formato es el siguiente: campo,operador,valor,nombrecampo1:nombrecampos2;campo,operador,valor,nombrecampo1
        </td>
    </tr>
    <tr class="bg-warning">
        <td>
            Incluir accordion: permite asociar un crud dentro de un crud, por un campo en común
        </td>
    </tr>
    <tr class="bg-warning">
        <td>
            Permisos accordion: (requiere Incluir accordion) permite configurar las acciones dentro de un accordion: crear, ver, editar, eliminar
        </td>
    </tr>
</table>