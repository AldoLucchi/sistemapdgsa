<table class="table border border-primary text-start">
    <thead>
        <tr class="text-uppercase fw-bold bg-gray-600">
            <td>Opción </td>
            <td>Descripción </td>
            <td>Ejemplo </td>
        </tr>
    </thead>
    <tbody>
        <tr class="bg-primary">
            <td>Indice:</td>
            <td>
                se utiliza para configurar el orden del campo en los listados y formularios de los CRUD
            </td>
            <td></td>
        </tr>
        <tr class="bg-primary">
            <td>Incluir campo:</td>
            <td>
                si ningún campo esta marcado para incluir, automáticamente se incluyen todos
            </td>
            <td></td>
        </tr>
        <tr class="bg-primary">
            <td>Incluir list:</td>
            <td>
                si ningún campo esta marcado para incluir, automáticamente se incluyen todos
            </td>
            <td></td>
        </tr>
        <tr class="bg-primary">
            <td>Alias: </td>
            <td>
                se utiliza para asignar un texto personalizado, en el label de un campo del CRUD
            </td>
            <td></td>
        </tr>
        <tr class="bg-primary">
            <td>Texto ayuda:</td>
            <td>
                se utiliza para asignar un texto de ayuda, debajo del campo, en los formularios de un CRUD
            </td>
            <td></td>
        </tr>
        <tr class="bg-primary">
            <td>Regex (validación):</td>
            <td>
                solo para campos de tipo: text, date, search, url, tel, email, and password.
            </td>
            <td>Ejemplos:
                <br>-validación de todos los caracteres en minúsuculas: ^[a-z][a-z0-9_.]*$
                <br>-validación solo letras: ^[a-zA-Z]*$
                <br>-validación para emails: ^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$
                <br>-validación para teléfono (9 dígitos): ^(\d{7})$

            </td>
        </tr>
        <tr class="bg-primary">
            <td>Maxlength (validación):</td>
            <td>
                se utiliza para limitar la cantidad de caracteres de un campo
            </td>
            <td></td>
        </tr>
        <tr class="bg-primary">
            <td>Requerido (validación):</td>
            <td>
                se utiliza para configurar un campo como obligatorio
            </td>
            <td></td>
        </tr>
        <tr class="bg-primary">
            <td>Readonly:</td>
            <td>
                se utiliza para configurar un campo como solo lectura
            </td>
            <td></td>
        </tr>
        <tr class="bg-primary">
            <td>Hidden: </td>
            <td>
                se utiliza para ocultar campos de los form de creación / edición
            </td>
            <td></td>
        </tr>
        <tr class="bg-success">
            <td> Seleccionar FK:</td>
            <td>
                se utiliza para configurar una tabla foranea asociada al campo. Esto permite desplegar un select con los valores de dicha tabla
            </td>
            <td></td>
        </tr>
        <tr class="bg-success">
            <td>Style Color: </td>
            <td>
                se utiliza para estilizar valores de campos select los listados. Colores válidos: primary, secondary, success, info, warning, danger, dark, white, muted, gray-100 a gray-900.
            </td>
            <td>Por ejemplo: idestatus,=,1,success;idestatus,=2,danger;
            </td>
        </tr>
        <tr class="bg-danger">
            <td>Campos anidados FK: </td>
            <td>
                (requiere Seleccionar FK) permite seleccionar una dependencia con otro campo, y esto habilita un filtrado dinámico según el valor seleccionado del campo dependiente
            </td>
            <td></td>
        </tr>
        <tr class="bg-danger">
            <td>Reglas SQL Select FK:</td>
            <td>
                (requiere Seleccionar FK) para setear una o más reglas de filtrado, en formato SQL
                <br>Nota: Usar comillas simples según corresponda
            </td>
            <td></td>
        </tr>
        <tr class="bg-danger">
            <td>Reglas Select FK:</td>
            <td>
                (requiere Seleccionar FK) para setear una o más reglas de filtrado, el formato es el siguiente: campo,operador,valor;campo,operador,valor
                <br> Nota: si Reglas SQL Select FK esta seteado, esta validación queda obsoleta.
            </td>
            <td></td>
        </tr>

        <tr class="bg-info">
            <td>Reglas CRUD anidado:</td>
            <td>
                (requiere Seleccionar FK) para setear una o más reglas de crud anidado, el formato es el siguiente: campo,operador,valor,idcrud,cantidadregistros;campo,operador,valor,idcrud,cantidadregistros
            </td>
            <td></td>
        </tr>
        <tr class="bg-info">
            <td>Reglas campos dependientes ocultos:</td>
            <td>
                (requiere Seleccionar FK) para setear una o más reglas de campos dependientes ocultos, el formato es el siguiente: campo,operador,valor,nombrecampo1:nombrecampos2;campo,operador,valor,nombrecampo1
            </td>
            <td></td>
        </tr>
        <tr class="bg-warning">
            <td>Incluir accordion:</td>
            <td>
                permite asociar un crud dentro de un crud, por un campo en común
            </td>
            <td></td>
        </tr>
        <tr class="bg-warning">
            <td>Permisos accordion:</td>
            <td>
                (requiere Incluir accordion) permite configurar las acciones dentro de un accordion: crear, ver, editar, eliminar
            </td>
            <td></td>
        </tr>
    </tbody>
</table>