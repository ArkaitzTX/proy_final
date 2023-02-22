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
        const miTipo = tipos[event.target.value];

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
        const val = Array.from(document.getElementsByClassName('validar'));
        let error = false;
        val.forEach(e => {
            if (e.value == "") {
                e.style.border = "2px solid red";
                e.focus();
                error = true;
            }
            else{
                e.style.border = "1px solid black";
            }
        });

        console.log(error);
        if(!error) {
            document.querySelector('form').submit();
        }
    });
}
