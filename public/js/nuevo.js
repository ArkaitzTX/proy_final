window.onload = () => {

    //TODO: VARIABLES
    const subirOpc = {
        "subir_principal": (reader) => {
            principal.setValue(reader.result);
        },
        "subir_secundario": (reader) => {
            secundario.setValue(reader.result);
        }
    };
    const tipos = [{
            nombre: 'css',
            vp: true,
            conexion: ["<style>", "</style>"]
        },
        {
            nombre: 'javascript',
            vp: true,
            conexion: ["<script>", "</script>"]
        },
        {
            nombre: 'json',
            vp: false,
            conexion: null
        }
    ];
    let activo = true;
    let tipoUsado = {
        nombre: 'css',
        vp: true,
        conexion: ["<style>", "</style>"]
    };


    //TODO: EDITOR DE CODIGO
    ace.require('ace/ext/language_tools');

    // PRINCIPAL
    let principal = ace.edit("principal");
    principal.getSession().setMode("ace/mode/css"); //CSS,JS...
    principal.setOptions({
        fontSize: '16pt',
        showLineNumbers: true,
        showGutter: true,
        vScrollBarAlwaysVisible: false,
        enableBasicAutocompletion: true,
        enableSnippets: true,
        enableLiveAutocompletion: true,
    });
    principal.setTheme("ace/theme/monokai");

    // SECUNDARIO
    let secundario = ace.edit("secundario");
    secundario.getSession().setMode("ace/mode/html");
    secundario.setOptions({
        fontSize: '16pt',
        showLineNumbers: true,
        showGutter: true,
        vScrollBarAlwaysVisible: false,
        enableBasicAutocompletion: true,
        enableSnippets: true,
        enableLiveAutocompletion: true,
    });
    secundario.setTheme("ace/theme/monokai");

    // VISTA
    principal.session.on("change", verVista);
    secundario.session.on("change", verVista);

    function verVista() {
        if (activo) {
            var vista = document.getElementById("vista");
            let html = secundario.getValue() + tipoUsado.conexion[0] + principal.getValue() + tipoUsado.conexion[1];

            vista.contentDocument.open();
            vista.contentDocument.write(html);
            vista.contentDocument.close();
        }
    }


    //TODO: SUBIR ARCHIVO
    document.getElementById("subir_principal").addEventListener('change', subirArchivos);
    document.getElementById("subir_secundario").addEventListener('change', subirArchivos);

    function subirArchivos(event) {
        const file = event.target.files[0];
        // LEER ARCHIVO
        const reader = new FileReader();
        reader.readAsText(file);
        reader.onload = () => {
            subirOpc[event.target.id](reader);
        };
    }


    //TODO: Activar/Desactivar HTML
    const checkbox = document.getElementById("check_vp");
    const div = document.getElementById("vp");

    // CHECKBOX
    checkbox.addEventListener("change", function () {
        if (this.checked) {
            des();
        } else {
            act();
        }
    });
    // ACTIVO
    function act() {
        activo = true;
        div.style.opacity = "1"; // Cambiar la opacidad del div a 100%
        div.querySelectorAll("input").forEach(input => input.disabled = false); // Habilitar todos los inputs dentro del div
        secundario.setReadOnly(false);
    }
    // DESACTIVADO
    function des() {
        activo = false;
        div.style.opacity = "0.3"; // Cambiar la opacidad del div a 50%
        div.querySelectorAll("input").forEach(input => input.disabled = true); // Deshabilitar todos los inputs dentro del div
        secundario.setReadOnly(true);
        //! ¿¿ELIMINAR CONTENIDO??
    }


    //TODO: CREAR Y MANEJAR EL SELECT
    const selectTipo = document.getElementById('tipo');

    // CREAR SELECT
    tipos.forEach((tipo, index) => {
        const option = document.createElement('option');
        option.value = Number(index+1);
        option.textContent = tipo.nombre;
        selectTipo.appendChild(option);
    });

    // APLICAR
    selectTipo.addEventListener("change", function (event) {
        const miTipo = tipos[Number(event.target.value-1)];

        // ELIMINAR TODO
        principal.setValue("");
        secundario.setValue("");

        // VISTA PREV
        if (miTipo.vp) {
            checkbox.checked = false;
            checkbox.disabled = false;
            act();
        } else {
            checkbox.checked = true;
            checkbox.disabled = true;
            des();
        }

        //TIPO DE ARCHIVO
        principal.getSession().setMode(`ace/mode/${miTipo.nombre}`);

        tipoUsado = miTipo;

    });

    // SUBMIT
    document.getElementById('enviar').addEventListener("click", function (event) {
        event.preventDefault();
        
        // Obtener los datos de los archivos
        let archivo1 = principal.getValue();
        let archivo2 = secundario.getValue();

        document.getElementById('archivo1').value = archivo1;
        document.getElementById('archivo2').value = archivo2;

        // Enviar el formulario
        // VALIDACION NOMBRE Y DESCRIPCION
        const LONG = {
            nombre: {
                longitud: 50,
                vacio: false
            },
            descripcion:  {
                longitud: 500,
                vacio: false
            },
            como: {
                longitud: 500,
                vacio: true
            },
        }
        const val = Array.from(document.getElementsByClassName('validar'));
        let error = false;
        val.forEach(e => {
            if (e.value == "" && !LONG[e.name].vacio) {
                e.style.border = "2px solid red";
                e.focus();
                error = true;

                document.getElementById(e.name+"_error").innerHTML = "El campo no puede estar vacio";
            }
            else if(LONG[e.name].longitud < e.value.length){
                e.style.border = "2px solid red";
                e.focus();
                error = true;

                document.getElementById(e.name+"_error").innerHTML = "El campo no puede tener una longitud superior a " + LONG[e.name].longitud;
            }
            else{
                e.style.border = "1px solid black";
                document.getElementById(e.name+"_error").innerHTML = "";
            }
        });

        if(!error) {
            document.querySelector('form').submit();
        }
    });

    // BOTON INFO
    document.getElementById('info').addEventListener("click", function (event) {
        Swal.fire({
            title: 'Informacion: ',
            html:
                '   \
                <b>Nombre:</b> Escriba el nombre de su proyecto.<br> \
                <b>Descripción:</b> Agregue una breve descripción de su proyecto.<br> \
                <b>Explicación:</b> Proporcione toda la información necesaria para que otros usuarios puedan usar e implementar su proyecto de manera efectiva. Esta sección es opcional, pero puede ser útil para mejorar la comprensión del proyecto.<br>\
                <b>Imagen:</b> Adjunte una imagen que muestre información relevante sobre su proyecto. Esto es opcional, pero puede ser útil para atraer la atención de otros usuarios.<br>\
                <b>Código principal:</b> Escriba el código principal de su proyecto. Tenga en cuenta que solo debe incluir el código principal que quiera compartir.<br>\
                <b>Código secundario:</b> Incluya cualquier otro código que sea necesario para que su proyecto funcione correctamente. Esta sección es opcional, pero puede ser útil para proporcionar ejemplos de cómo implementar el código principal. Tenga en cuenta que esta sección es de tipo HTML, por lo que puede agregar tanto HTML, CSS(style) como JS(script).<br><br>\
                ',
            focusConfirm: false,
          })
    });

}
