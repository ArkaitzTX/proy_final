window.onload = () => {

    //TODO: Variables
    const tipos = [{
            nombre: 'css',
            vp: true,
            conexion: ["<style>\n", "\n</style>"]
        },
        {
            nombre: 'javascript',
            vp: true,
            conexion: ["<script>\n (function activar(){\n", "\n})();\n</script>"]
        },
        {
            nombre: 'json',
            vp: false,
            conexion: null
        }
    ];
    const datos = JSON.parse(document.getElementById("info").value);

    const archivo = datos.archivo;
    const modo = tipos[datos.tipo - 1].nombre;
    const tipoUsado = tipos[datos.tipo - 1].conexion;
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

    async function pasarData(codigo, tipo) {
        try {
            tipo = tipo == "javascript" ? "js" : tipo;
            // console.log('/proyectos/' + tipo + '/' + archivo + '.' + tipo);
            const response = await fetch('/proyectos/' + tipo + '/' + archivo + '.' + tipo);
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
    document.getElementById("copiar").addEventListener('click', function () {
        // Obtiene el URL actual de la página
        var link = window.location.href;
        // Copia el URL al portapapeles
        navigator.clipboard.writeText(link)
            .then(function () {
                Swal.fire({
                    icon: 'success',
                    text: 'URL copiado al portapapeles!',
                    timer: 1000,
                    showConfirmButton: false
                })
            })
            .catch(function (error) {
                console.error('No se pudo copiar el URL al portapapeles: ', error);
            });
    })

    //TODO: Copiar codigo
    const COPIADOS = Array.from(document.getElementsByClassName("copiar"));

    COPIADOS.forEach(element => {
        element.addEventListener('click', function (event) {
            const key = event.target.id;
            const datos = {
                "c_1": principal.getValue(),
                "c_2": secundario.getValue(),
            }

            navigator.clipboard.writeText(datos[key])
                .then(function () {
                    Swal.fire({
                        icon: 'success',
                        text: 'Codigo copiado al portapapeles!',
                        timer: 1000,
                        showConfirmButton: false
                    })
                })
                .catch(function (error) {
                    console.error('No se pudo copiar el codigo al portapapeles: ', error);
                });

        });
    });

    //TODO: Descargar Todo
    document.getElementById("descargar").addEventListener('click', function () {

        // ARCHIVOS
        let zip = new JSZip();

        //1
        let nuevotipo1 = modo == "javascript" ? "js" : modo;
        let nombreArchivo = 'principal' + '.' + nuevotipo1;
        zip.file(nombreArchivo, principal.getValue(), {
            binary: true
        });

        // 2
        if (vp) {
            const LINK = [
                '<link rel="stylesheet" href="principal.css">',
                '<script src="principal.js"></script>'
            ];
            let contenido = secundario.getValue() + '\n' + LINK[datos.tipo - 1];

            let nombreArchivo = 'secundario.html';
            zip.file(nombreArchivo, contenido, {
                binary: true
            });
        }

        // zip
        zip.generateAsync({
            type: "blob"
        }).then(function (blob) {
            saveAs(blob, "codigo.zip");
        });

    })

    ////TODO:  Descargar
    const DESCARGADOS = Array.from(document.getElementsByClassName("descargar"));

    DESCARGADOS.forEach(element => {
        element.addEventListener('click', function (event) {
            let nuevotipo2 = modo == "javascript" ? "js" : modo;
            const key = event.target.id;
            const datos = {
                "d_1": principal.getValue(),
                "d_2": secundario.getValue(),
            }
            const nombre = {
                "d_1": 'principal.' + nuevotipo2,
                "d_2": 'secundario.html',
            }

            // Descargar
            // Crea un objeto URL a partir del Blob para descargar el archivo
            let blob = new Blob([datos[key]]);
            let url = window.URL.createObjectURL(blob);

            // Crea un elemento <a> para descargar el archivo
            let link = document.createElement('a');
            link.href = url;
            link.download = nombre[key];
            link.click();

            // Limpia el objeto URL creado
            window.URL.revokeObjectURL(url);


        });
    });

    //TODO: COMENTARIOS
    const textoInput = document.getElementById("texto");
    const contadorCaracteres = document.getElementById("texto-char");

    textoInput.addEventListener("input", function () {
        const longitudTexto = textoInput.value.length;
        contadorCaracteres.textContent = `${longitudTexto}/250`;

        if (longitudTexto >= 249) {
            textoInput.value = textoInput.value.slice(0, 249);
        }
    });

}
