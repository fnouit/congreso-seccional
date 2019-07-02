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
                    <i class="fa fa-align-justify"></i> Niveles Educativos
                    <button type="button" @click="abrirModal('nivel','registrar')" class="btn btn-secondary">
                        <i class="icon-plus"></i>&nbsp;Nuevo
                    </button>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <select class="form-control col-md-3" v-model="criterio">
                                    <option value="nivel_educativo" selected>Nivel</option>
                                </select>
                                <input type="text" v-model="buscar" @keyup.enter="listarNivel(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                <button type="submit" @click="listarNivel(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Opciones</th>
                                <th>Número progresivo</th>
                                <th>Nivel Educativo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(nivel, index) in arrayNivel" :key="nivel.id" >
                                <td>
                                    <button type="button" @click="abrirModal('nivel', 'actualizar', nivel)" class="btn btn-warning btn-sm" >
                                        <i class="icon-pencil"></i>
                                    </button> &nbsp;
                                    <button type="button" @click="abrirModal('nivel', 'informacion', nivel)" class="btn btn-info btn-sm" >
                                        <i class="icon-eye"></i>
                                    </button>                                            
                                    <button type="button" class="btn btn-danger btn-sm" @click="eliminarNivel(nivel.id)" >
                                        <i class="icon-trash"></i>
                                    </button>                                            
                                </td>
                                <td v-text="index + 1"></td>
                                <td v-text="nivel.nivel_educativo"></td>
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




        <!--Inicio del modal agregar/actualizar-->
        <div class="modal fade" tabindex="-1" role="dialog" :class="{'mostrar' : modal}" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-primary modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 v-text="tituloModal" class="modal-title"></h4>
                        <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" class="form-horizontal">
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="nombre" class="form-control" placeholder="Nombre del nivel" style="text-transform: uppercase;"  :disabled="desabilitar == 1">
                                </div>
                            </div>                                                   

                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Su slug</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="slug" class="form-control" placeholder="slug de url" :disabled="desabilitar == 1">
                                </div>
                            </div>

                            <div v-show="errorNivel" class="form-group row div-error">
                                <div class="col-md-9 text-error">
                                    <div v-for="error in errorMsgNivel" :key="error" v-text="error" >

                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                        <button type="button" v-if="btnAccion == 1" class="btn btn-primary" @click="registrarNivel()">Guardar</button>
                        <button type="button" v-if="btnAccion == 2" class="btn btn-primary" @click="actualizarNivel()" >Actualizar</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!--Fin del modal-->
        
    </main>
</template>

<script>
    export default {
        data () {
            return {
                nivel_id : 0,
                nombre : '',
                sede : '',
                slug : '',
                arrayNivel : [],
                modal : 0,
                tituloModal : '',
                btnAccion : 0,
                errorNivel : 0,
                errorMsgNivel : [],
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
                criterio : 'nivel_educativo',
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
            listarNivel(page,buscar,criterio) {
                let me=this;
                var url = '/admin/niveles?page='+page+'&buscar='+buscar+'&criterio='+criterio;
                axios.get(url).then(function (response) {
                        var respuesta = response.data;
                        me.arrayNivel = respuesta.niveles.data;
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
                me.listarNivel(page,buscar,criterio);
            },
            registrarNivel() {
                if (this.validarNivel()) {
                    return;
                }
                let me=this;
                axios.post('/admin/nivel/registrar',{
                    'nombre' : this.nombre,                    
                    'slug' : this.slug,                    
                }).then(function (response) {
                        me.cerrarModal();
                        me.listarNivel(1,'','nombre');
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    });
            },
            actualizarNivel() {
                if (this.validarNivel()) {
                    return;
                }
                let me=this;
                axios.put('/admin/nivel/actualizar/',{
                    'nombre' : this.nombre,
                    'slug' : this.slug,    
                    'id' : this.nivel_id
                }).then(function (response) {
                        me.cerrarModal();
                        me.listarNivel(1,'','nombre');
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    });
            },
            eliminarNivel(id){
                Swal.fire({               
                    title: '¿Estás seguro?',
                    text: "¡No podrás revertir esto!"+this.nombre,
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Canelar',
                    confirmButtonText: '¡Sí, borrar registro!'
                }).then((result) => {
                if (result.value) {
                        // console.log(id);
                        let me = this;
                        axios.delete('/admin/nivel/eliminar/'+id)
                        .then(function (response) {
                            me.listarNivel(1,'','nombre');
                            Swal.fire(
                                '¡Borrado!',
                                'Su registro ha sido eliminado.',
                                'success'
                            )
                        })
                        .catch(function (error) {
                            console.log('error: ' + error);
                        });
                    }
                })                
            },
            validarNivel(){
                this.errorNivel=0;
                this.errorMsgNivel = [];

                if (!this.nombre) this.errorMsgNivel.push("El campo nombre no puede estar vacio");
                if (!this.slug) this.errorMsgNivel.push("El campo slug no puede estar vacio");
                if (this.errorMsgNivel.length) this.errorNivel = 1;
                return this.errorNivel;
            },
            cerrarModal() {
                this.tituloModal = '';
                this.modal = 0;
                this.nombre = '';
                this.slug = '';
                this.desabilitar = 0;

            },
            abrirModal(modelo, accion, data = []) {
                switch (modelo) {
                    case "nivel": {
                        switch (accion) {
                            case "registrar": {
                                this.tituloModal = 'Nuevo Nivel Educativo';
                                this.modal = 1;
                                this.nombre = '';
                                this.slug = '';
                                this.btnAccion = 1;
                                break;                               
                            }

                            case "actualizar": {
                                this.nivel_id = data['id'];
                                this.tituloModal = 'Actualizar Nivel Educativo';
                                this.modal = 1;
                                this.nombre = data['nivel_educativo'];
                                this.slug = data['slug'];
                                this.btnAccion = 2;
                                break;                               
                            }

                            case "informacion": {
                                this.nivel_id = data['id'];
                                this.tituloModal = 'Mostrar información del nivel';
                                this.modal = 1;
                                this.nombre = data['nivel_educativo'];
                                this.slug = data['slug'];
                                this.btnAccion = 3;
                                this.desabilitar = 1;
                                break;  
                            }
                        }
                    }
                }
            }
        },
        mounted() {
            console.log('Component mounted.')
            this.listarNivel(1,this.buscar, this.criterio);
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
