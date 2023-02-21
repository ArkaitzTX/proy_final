window.onload = () => {

    const filtros = Vue.createApp({})
    filtros.component('filtros', {
        props: ['pro'],
        data() {
            return {
                misProyectos: JSON.parse(this.pro),
                busqueda: ""
            }
        },
        template: `
        <div v-for="proy in filtrar" class="py-4 py-xl-5">
            <div class="container" style="padding-left: 12px;">
                <div class="bg-dark border rounded border-0 border-dark overflow-hidden">
                    <div class="row g-0">
                        <div class="col-md-6 order-first order-md-last">
                            <div class="text-white p-4 p-md-5">
                                <h2 class="fw-bold text-white mb-3">{{ proy.nombre }}</h2>
                                <p class="mb-4">{{ proy.descripcion }}</p>
                                <div class="my-3">
                                    <a class="btn btn-primary btn-lg me-2" role="button"
                                    href="#">Ver</a>
                                    <a class="btn btn-light btn-lg" role="button"
                                    href="#">Descargar</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" style="min-height: 250px;">
                            <img class="w-100 h-100 fit-cover" :src="'/proyectos/images/' + proy.img">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        `,
        computed: {
            filtrar(){
                return this.misProyectos.data;
            }
        },
        created() {
            
        }
    });
 
    filtros.mount('#projects');

}