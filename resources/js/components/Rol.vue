<template>
    <main class="main">
        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        <div class="container-fluid">
            <!-- Ejemplo de tabla Listado -->
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> Roles Administrativos
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <select class="form-control col-md-3" v-model="criterio">
                                    <option value="nombre" selected>Nombre</option>
                                    <option value="descripcion">Descripcion</option>
                                </select>
                                <input type="text" v-model="buscar" @keyup.enter="listarRol(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                <button type="submit" @click="listarRol(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>

                                <th>Número progresivo</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(rol, index) in arrayRol" :key="rol.id" >
                                <td v-text="index + 1"></td>
                                <td v-text="rol.nombre"></td>
                                <td v-text="rol.descripcion"></td>
                            </tr>
                        </tbody>
                    </table>
                    <nav>
                        <ul class="pagination">
                            <li class="page-item" v-if="pagination.current_page > 1" >
                                <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)">Ant</a>
                            </li>
                            <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']" >
                                <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page" ></a>
                            </li>
                            <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)">Sig</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- Fin ejemplo de tabla Listado -->
        </div>       
    </main>
</template>

<script>
    export default {
        data () {
            return {
                rol_id : 0,
                nombre : '',
                descripcion : '',
                arrayRol : [],
                modal : 0,
                tituloModal : '',
                btnAccion : 0,
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,	
                    'last_page' : 0,
                    'first_page' : 0,
                    'from' : 0,	
                    'to' : 0
                },
                offset : 3,
                criterio : 'rol_educativo',
                buscar : '',
                desabilitar: 0
            }
        },
        computed:{
            isActived: function(){
                return this.pagination.current_page;
            },
            // Calculando los elementos de la paginación
            pagesNumber: function(){
                if (!this.pagination.to) {
                    return [];
                }
                var from = this.pagination.current_page - this.offset;
                if (from < 1) {
                    from = 1;
                }
                var to = from + (this.offset * 2);
                if (to >= this.pagination.last_page) {
                    to = this.pagination.last_page;
                }
                var pageArray = []
                while (from <= to){
                    pageArray.push(from);
                    from++;
                }
                return pageArray;
            }
        },
        methods : {
            listarRol(page,buscar,criterio) {
                let me=this;
                var url = '/admin/roles?page='+page+'&buscar='+buscar+'&criterio='+criterio;
                axios.get(url).then(function (response) {
                        var respuesta = response.data;
                        me.arrayRol = respuesta.roles.data;
                        me.pagination = respuesta.pagination;
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    });

            },
            cambiarPagina(page,buscar,criterio) {
                let me = this;
                me.pagination.current_page = page;
                me.listarRol(page,buscar,criterio);
            }
        },
        mounted() {
            console.log('Component mounted.')
            this.listarRol(1,this.buscar, this.criterio);
        }
    }
</script>
<style>
    .modal-content {
        width: 100% !important;
        position:absolute !important;
    }
    .mostrar {
        display: list-item !important;
        opacity: 1 !important;
        position: absolute !important;
        background-color: #3c29297a !important;
    }
    .div-erro {
        display: flex;
        justify-content: center;        
    }
    .text-error {
        color: brown !important;
        font-weight: bold;
    }
</style>
