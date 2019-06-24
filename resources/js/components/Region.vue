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
                    <i class="fa fa-align-justify"></i> Regiones
                    <button type="button" @click="abrirModal('region','registrar')" class="btn btn-secondary">
                        <i class="icon-plus"></i>&nbsp;Nuevo
                    </button>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <select class="form-control col-md-3" v-model="criterio">
                                    <option value="nombre">Región</option>
                                    <option value="sede">Sede</option>
                                    <option value="coordinador">Coordinador</option>
                                </select>
                                <input type="text" v-model="buscar" @keyup.enter="listarRegion(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                <button type="submit" @click="listarRegion(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Opciones</th>
                                <th>Nombre</th>
                                <th>Sede</th>
                                <th>Coordinador</th>
                                <th>Correo electrónico</th>
                                <th>Imágen</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(region) in arrayRegion" :key="region.id" >
                                <td>
                                    <button type="button" @click="abrirModal('region', 'actualizar', region)" class="btn btn-warning btn-sm" >
                                        <i class="icon-pencil"></i>
                                    </button> &nbsp;
                                    <button type="button" @click="abrirModal('region', 'informacion', region)" class="btn btn-info btn-sm" >
                                        <i class="icon-eye"></i>
                                    </button>                                            
                                    <button type="button" class="btn btn-danger btn-sm" @click="eliminarRegion(region.id)" >
                                        <i class="icon-trash"></i>
                                    </button>                                            
                                </td>
                                <td v-text="region.nombre"></td>
                                <td v-text="region.sede"></td>
                                <td v-text="region.coordinador"></td>
                                <td v-text="region.email"></td>
                                <td></td>
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
                        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="nombre" class="form-control" placeholder="Nombre de la región" style="text-transform: uppercase;"  :disabled="desabilitar == 1">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input" >Sede</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="sede" class="form-control" placeholder="Sede de la región" style="text-transform: uppercase;" :disabled="desabilitar == 1">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Coordinador</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="coordinador" class="form-control" placeholder="Nombre completo del coordinador regional" style="text-transform: uppercase;" :disabled="desabilitar == 1">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Correo electrónico</label>
                                <div class="col-md-9">
                                    <input type="email" v-model="correo"  class="form-control" placeholder="¿Cúal es su correo electrónico?" :disabled="desabilitar == 1">
                                </div>
                            </div>                                                        

                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Teléfono</label>
                                <div class="col-md-9">
                                    <input type="tel" v-model="telefono" class="form-control" placeholder="¡Su teléfono es!" :disabled="desabilitar == 1">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Su slug</label>
                                <div class="col-md-9">
                                    <input type="tel" v-model="slug" class="form-control" placeholder="slug de url" :disabled="desabilitar == 1">
                                </div>
                            </div>

                            <div v-show="erroRegion" class="form-group row div-error">
                                <div class="col-md-9 text-error">
                                    <div v-for="error in errorMsgRegion" :key="error" v-text="error" >

                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                        <button type="button" v-if="btnAccion == 1" class="btn btn-primary" @click="registrarRegion()">Guardar</button>
                        <button type="button" v-if="btnAccion == 2" class="btn btn-primary" @click="actualizarRegion()" >Actualizar</button>
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
                region_id : 0,
                nombre : '',
                sede : '',
                coordinador : '',
                correo : '',
                telefono : '',
                // photo : '',
                slug : '',
                arrayRegion : [],
                modal : 0,
                tituloModal : '',
                btnAccion : 0,
                erroRegion : 0,
                errorMsgRegion : [],
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
                criterio : 'nombre',
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
            listarRegion(page,buscar,criterio) {
                let me=this;
                var url = '/admin/regiones?page='+page+'&buscar='+buscar+'&criterio='+criterio;
                axios.get(url).then(function (response) {
                        var respuesta = response.data;
                        me.arrayRegion = respuesta.regiones.data;
                        me.pagination = respuesta.pagination;
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })
                    .finally(function () {
                        // always executed
                    });

            },
            cambiarPagina(page,buscar,criterio) {
                let me = this;
                me.pagination.current_page = page;
                me.listarRegion(page,buscar,criterio);
            },
            registrarRegion() {
                if (this.validarRegion()) {
                    return;
                }
                let me=this;
                axios.post('/admin/region/registrar',{
                    'nombre' : this.nombre,
                    'sede' : this.sede,
                    'coordinador' : this.coordinador,
                    'correo' : this.correo,
                    'telefono' : this.telefono,                    
                    'slug' : this.slug,                    
                }).then(function (response) {
                        me.cerrarModal();
                        me.listarRegion(1,'','nombre');
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })
                    .finally(function () {
                        // always executed
                    });
            },
            actualizarRegion() {
                if (this.validarRegion()) {
                    return;
                }
                let me=this;
                axios.put('/admin/region/actualizar/',{
                    'nombre' : this.nombre,
                    'sede' : this.sede,
                    'coordinador' : this.coordinador,
                    'correo' : this.correo,
                    'telefono' : this.telefono,                    
                    'slug' : this.slug,    
                    'id' : this.region_id
                }).then(function (response) {
                        me.cerrarModal();
                        me.listarRegion(1,'','nombre');
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })
                    .finally(function () {
                        // always executed
                    });
            },
            eliminarRegion(id){
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
                        axios.delete('/admin/region/eliminar/'+id)
                        .then(function (response) {
                            me.listarRegion(1,'','nombre');
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
            validarRegion(){
                this.erroRegion=0;
                this.errorMsgRegion = [];

                if (!this.nombre) this.errorMsgRegion.push("El campo nombre no puede estar vacio");
                if (!this.sede) this.errorMsgRegion.push("El campo sede necesita un título");
                if (!this.coordinador) this.errorMsgRegion.push("Es necesario un nombre de coordinador");
                if (!this.correo) this.errorMsgRegion.push("El campo correo no puede estar vacio");
                if (!this.telefono) this.errorMsgRegion.push("Se requiere un número telefonico para este campo");
                if (!this.slug) this.errorMsgRegion.push("El campo slug no puede estar vacio");
                if (this.errorMsgRegion.length) this.erroRegion = 1;
                return this.erroRegion;
            },
            cerrarModal() {
                this.tituloModal = '';
                this.modal = 0;
                this.nombre = '';
                this.sede = '';
                this.coordinador = '';
                this.correo = '';
                this.telefono = '';
                // this.photo = '';
                this.slug = '';
                this.desabilitar = 0;

            },
            abrirModal(modelo, accion, data = []) {
                switch (modelo) {
                    case "region": {
                        switch (accion) {
                            case "registrar": {
                                this.tituloModal = 'Nueva Región';
                                this.modal = 1;
                                this.nombre = '';
                                this.sede = '';
                                this.coordinador = '';
                                this.correo = '';
                                this.telefono = '';
                                // this.photo = '';
                                this.slug = '';
                                this.btnAccion = 1;
                                break;                               
                            }

                            case "actualizar": {
                                this.region_id = data['id'];
                                this.tituloModal = 'Actualizar Región';
                                this.modal = 1;
                                this.nombre = data['nombre'];
                                this.sede = data['sede'];
                                this.coordinador = data['coordinador'];
                                this.correo = data['email'];
                                this.telefono = data['telefono'];
                                // this.photo = data['photo'];
                                this.slug = data['slug'];
                                this.btnAccion = 2;
                                
                                break;                               
                            }

                            case "informacion": {
                                this.region_id = data['id'];
                                this.tituloModal = 'Mostrar información de la Region';
                                this.modal = 1;
                                this.nombre = data['nombre'];
                                this.sede = data['sede'];
                                this.coordinador = data['coordinador'];
                                this.correo = data['email'];
                                this.telefono = data['telefono'];
                                // this.photo = data['photo'];
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
            // console.log('Component mounted.')
            this.listarRegion(1,this.buscar, this.criterio);
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
