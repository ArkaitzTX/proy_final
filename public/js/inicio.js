window.onload = () => {

    const filtros = Vue.createApp({})
    filtros.component('filtros', {
        props: ['pro', 'lang'],
        data() {
            return {
                idiomas: this.lang ?? "en",
                misProyectos: JSON.parse(this.pro),
                busqueda: "",
                fecha: "0",
                tipo: "0",
                tipos: ['css', 'js', 'json'],
                i: {
                    "es": {
                        "t1": "Mas Nuevos",
                        "t2": "Mas Viejos",
                        "t3": "Todo",
                        "t4": "Ver",
                        "t5": "Descargar",
                        "t6": "Buscar proyecto",
                    },
                    "eu": {
                        "t1": "Berriak lehenengoak",
                        "t2": "Zaharrak lehenengoak",
                        "t3": "Guztiak",
                        "t4": "Ikusi",
                        "t5": "Deskargatu",
                        "t6": "Bilatu Proiektua"
                    },
                    "en": {
                        "t1": "Most Recent",
                        "t2": "Oldest",
                        "t3": "All",
                        "t4": "View",
                        "t5": "Download",
                        "t6": "Search Project"
                    }
                }
            }
        },
        template: `
    <article id="filtros">
    <div class="w-75 d-flex align-items-center">
        <div class="d-flex align-items-center justify-content-around text-light">
            <input class="form-control mr-sm-2" type="search" :placeholder="i[idiomas]['t6']" aria-label="Search" v-model="busqueda">
            <select class="form-select w-25 mx-4" aria-label="Default select example" v-model="fecha">
                <option value="0">{{i[idiomas]["t1"]}}</option>
                <option value="1">{{i[idiomas]["t2"]}}</option>
            </select>
            <select class="form-select w-25" aria-label="Default select example" v-model="tipo">
                <option selected value="0">{{i[idiomas]["t3"]}}</option>
                <option value="1">css</option>
                <option value="2">js</option>
                <option value="3">json</option>
            </select>
            </div>
        </div>
    </article>

    <article id="projects">
        <div v-for="(proy, index) in filtrar"  id="tarjetaproy"  class="py-4 py-xl-5">
            <div class="container" style="padding-left: 12px;">
                <div class="bg-dark border rounded border-0 border-dark overflow-hidden">
                    <div class="row g-0">
                        <div class="col-md-6 order-first order-md-last">
                            <div class="text-white p-4 p-md-5">
                                <h4 class="fw-bold text-white mb-3">{{ proy.nombre }}</h4>
                                <p class="mb-4">{{ proy.descripcion }}</p>
                                <div class="my-3">
                                    <a class="btn btn-primary btn-lg me-2" role="button" :href="'view/'+proy.id">{{i[idiomas]["t4"]}}</a>
                                    <button :id="proy.id" class="btn btn-light btn-lg" role="button" @click="descargar">{{i[idiomas]["t5"]}}</button>
                                </div>
                            </div>
                        </div>
                        <div id="contenedor" class="col-md-6" style="min-height: 250px;">
                          <div class="bg-dark text-light rounded" id="tipo">
                            {{ tipos[proy.tipo - 1] }}                    
                          </div>
                            <img class="w-100 h-100 fit-cover" :src="'/proyectos/images/' + proy.img">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
        `,
        computed: {
            filtrar() {
                return this.misProyectos.data
                    .filter(proyecto => {
                        let tipoCondicion = true;
                        let busquedaCondicion = true;

                        if (this.tipo !== '0') {
                            tipoCondicion = proyecto.tipo == this.tipo;
                        }

                        if (this.busqueda !== '') {
                            busquedaCondicion =
                                proyecto.nombre.toLowerCase().includes(this.busqueda.toLowerCase()) ||
                                proyecto.descripcion.toLowerCase().includes(this.busqueda.toLowerCase());
                        }

                        return tipoCondicion && busquedaCondicion;
                    })
                    .sort((proyecto1, proyecto2) => {
                        if (this.fecha === '1') {
                            return new Date(proyecto1.created_at) - new Date(proyecto2.created_at);
                        } else {
                            return new Date(proyecto2.created_at) - new Date(proyecto1.created_at);
                        }
                    });
            }
        },
        methods: {
            descargar(event) {
                const proyecto = this.misProyectos.data.find(objeto => objeto.id == event.target.id);

                // ARCHIVOS
                let misTipos = ["css", "js", "json"];
                let ruta1 = '/proyectos/' + misTipos[proyecto.tipo - 1] + '/';
                let zip = new JSZip();

                //1
                const promesa1 = axios.get(ruta1 + proyecto.archivo + '.' + misTipos[proyecto.tipo - 1], {
                        responseType: 'blob'
                    })
                    .then(response => {
                        // Añadir archivo 1 al zip
                        let extension = proyecto.extension ? '.' + proyecto.extension : '';
                        let nombreArchivo = 'principal' + extension + '.' + misTipos[proyecto.tipo - 1];
                        zip.file(nombreArchivo, response.data, {
                            binary: true
                        });
                    });

                //2
                if (proyecto.vista_prev) {
                    let ruta2 = '/proyectos/html/';
                    axios.get(ruta2 + proyecto.archivo + '.html')
                        .then(response => {
                            // Añadir archivo 2 al zip
                            const LINK = [
                                '<link rel="stylesheet" href="principal.' + misTipos[proyecto.tipo - 1] + '">',
                                '<script src="principal.' + misTipos[proyecto.tipo - 1] + '"></script>'
                            ];
                            let contenido = response.data + '\n' + LINK[proyecto.tipo - 1];
                            zip.file('secundario.html', contenido);

                            // Descargar zip
                            Promise.all([promesa1]).then(() => {
                                zip.generateAsync({
                                    type: "blob"
                                }).then(function (blob) {
                                    saveAs(blob, "codigo.zip");
                                });
                            });
                        });
                } else {
                    // Descargar zip
                    Promise.all([promesa1]).then(() => {
                        zip.generateAsync({
                            type: "blob"
                        }).then(function (blob) {
                            saveAs(blob, "codigo.zip");
                        });
                    });
                }
            }
            // 
        }
    });

    filtros.mount('#proyectos');

}
