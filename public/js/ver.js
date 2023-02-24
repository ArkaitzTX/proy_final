window.onload = () => {

    //TODO: Variables
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
    let modo = 'css';
    let tipoUsado = {
        nombre: 'css',
        vp: true,
        conexion: ["<style>", "</style>"]
    };


    //TODO: Ejecutar codigo(ACE)
    ace.require('ace/ext/language_tools');

    // PRINCIPAL
    // !Elegir modo con el tipo
    // !Elegir tipoUsado con el tipo
    let principal = ace.edit("principal");
    principal.getSession().setMode("ace/mode/"+modo);
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
    // Activar o desactivar depende de vp
    if (true) {
        principal.session.on("change", verVista);
        secundario.session.on("change", verVista);
    }

    function verVista() {
        var vista = document.getElementById("vista");
        let html = secundario.getValue() + tipoUsado.conexion[0] + principal.getValue() + tipoUsado.conexion[1];

        vista.contentDocument.open();
        vista.contentDocument.write(html);
        vista.contentDocument.close();
    }

    //TODO: Compartir
    function copiar() {
        // Obtiene el URL actual de la página
        var link = window.location.href;
        // Copia el URL al portapapeles
        navigator.clipboard.writeText(link)
            .then(function () {
                console.log('URL copiado al portapapeles!');
            })
            .catch(function (error) {
                console.error('No se pudo copiar el URL al portapapeles: ', error);
            });
    }

    //TODO: Copiar codigo

    //TODO: Descargar Todo
    //TODO: Descargar

    //TODO: Comentarios


}
