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
    const datos = JSON.parse(document.getElementById("info").value);

    const archivo = datos.archivo;
    const modo = tipos[datos.tipo-1].nombre;
    const tipoUsado = tipos[datos.tipo-1].conexion;
    const vp = Boolean(datos.vista_prev);

    //TODO: Ejecutar codigo(ACE)
    ace.require('ace/ext/language_tools');
    let secundario = '';
    let principal = '';

    // PRINCIPAL
    principal = ace.edit("principal");
    principal.getSession().setMode("ace/mode/" + modo);
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
    principal.session.on("change", verVista);

    pasarData(principal, modo);


    // OTRO
    if (vp) {

        // SECUNDARIO
        secundario = ace.edit("secundario");
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
        secundario.session.on("change", verVista);

        pasarData(secundario, 'html');

    }

    async function pasarData(codigo, tipo){
        try {
            const response = await fetch('/proyectos/'+tipo+'/'+archivo+'.'+tipo);
            const valor = await response.text();

            codigo.setValue(valor);
        } catch (error) {
            console.error(error);
        }
    }

    function verVista() {
        var vista = document.getElementById("vista");

        let html = (vp) ? 
            secundario.getValue() + tipoUsado[0] + principal.getValue() + tipoUsado[1] :
            principal.getValue();

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




    // !EN PROCESO
    //TODO: Copiar codigo

    //TODO: Descargar Todo
    //TODO: Descargar

    //TODO: Comentarios


}
