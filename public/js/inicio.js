window.onload = () => {

    const filtros = Vue.createApp({})
    filtros.component('filtros', {
        props: ['pro'],
        data() {
            return {
                misProyectos: JSON.parse(this.pro),
                busqueda: "",
                fecha: "0",
                tipo: "0",
                tipos: ['css', 'js', 'json'],
            }
        },
        template: `
    <article id="filtros">
        <div class="rounded d-flex align-items-center justify-content-around text-light bg-opacity-75 bg-dark">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" v-model="busqueda">
            <select class="form-select w-25" aria-label="Default select example" v-model="fecha">
                <option value="0">Mas Nuevos</option>
                <option value="1">Mas Viejos</option>
            </select>
            <select class="form-select w-25" aria-label="Default select example" v-model="tipo">
                <option selected value="0">Todo</option>
                <option value="1">css</option>
                <option value="2">js</option>
                <option value="3">json</option>
            </select>
        </div>
    </article>

    <article id="projects">
        <div v-for="(proy, index) in filtrar"  id="tarjetaproy"  class="py-4 py-xl-5">
            <div class="container" style="padding-left: 12px;">
                <div class="bg-dark border rounded border-0 border-dark overflow-hidden">
                    <div class="row g-0">
                        <div class="col-md-6 order-first order-md-last">
                            <div class="text-white p-4 p-md-5">
                                <h2 class="fw-bold text-white mb-3">{{ proy.nombre }}</h2>
                                <p class="mb-4">{{ proy.descripcion }}</p>
                                <div class="my-3">
                                    <a class="btn btn-primary btn-lg me-2" role="button" :href="'view/'+proy.id">Ver</a>
                                    <button :id="proy.id" class="btn btn-light btn-lg" role="button" @click="descargar">Descargar</button>
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
            filtrar(){
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
            // ! SIN ZIP
            // descargar(event){
            //     const proyecto = this.misProyectos.data.find(objeto => objeto.id == event.target.id);

            //     // ARCHIVOS
            //     //1
            //     let misTipos = ["css", "js", "json"];
            //     let ruta1 = '/proyectos/' + misTipos[proyecto.tipo-1] + '/';
            
            //     axios.get(ruta1 + proyecto.archivo + '.' + misTipos[proyecto.tipo-1], {
            //         responseType: 'blob'
            //     })
            //     .then(response => {
            //         // Crea un objeto URL a partir del Blob para descargar el archivo
            //         let blob = new Blob([response.data]);
            //         let url = window.URL.createObjectURL(blob);
            
            //         // Crea un elemento <a> para descargar el archivo
            //         let link = document.createElement('a');
            //         link.href = url;
            //         link.download = 'principal.' + misTipos[proyecto.tipo-1];
            //         link.click();
            
            //         // Limpia el objeto URL creado
            //         window.URL.revokeObjectURL(url);
            //     });
            //     //2
            //     if (proyecto.vista_prev) {
            //         let ruta2 = '/proyectos/html/';
            //         axios.get(ruta2 + proyecto.archivo + '.html')
            //         .then(response => {
            //             //Crea el link de conexion
            //             const LINK = [
            //                 '<link rel="stylesheet" href="principal.'+misTipos[proyecto.tipo-1]+'">',
            //                 '<script src="principal.'+misTipos[proyecto.tipo-1]+'"></script>'
            //             ];
            //             let contenido = LINK[proyecto.tipo-1] + '\n' + response.data;

            //             // Crea un objeto URL a partir del Blob para descargar el archivo
            //             let blob = new Blob([contenido]);
            //             let url = window.URL.createObjectURL(blob);
                
            //             // Crea un elemento <a> para descargar el archivo
            //             let link = document.createElement('a');
            //             link.href = url;
            //             link.download = 'secundario.html';
            //             link.click();
                
            //             // Limpia el objeto URL creado
            //             window.URL.revokeObjectURL(url);
            //         });
            //     }   
            // }
            // ! CON ZIP
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
                  console.log(misTipos[proyecto.tipo - 1]);
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
                      let contenido = LINK[proyecto.tipo - 1] + '\n' + response.data;
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