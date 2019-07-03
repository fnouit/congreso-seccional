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
                    <i class="fa fa-align-justify"></i> Delegaciones
                    <button type="button" @click="abrirModal('delegacion','registrar')" class="btn btn-secondary">
                        <i class="icon-plus"></i>&nbsp;Nuevo
                    </button>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <select class="form-control col-md-3" v-model="criterio">
                                    <option value="slug" selected>Delegación</option>
                                    <option value="sede">Sede</option>
                                </select>
                                <input type="text" v-model="buscar" @keyup.enter="listarDelegacion(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                <button type="submit" @click="listarDelegacion(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Opciones</th>
                                <th>Delegación</th>
                                <th>Sede</th>
                                <th>Nivel Educativo</th>
                                <th>Región</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(delegacion) in arrayDelegacion" :key="delegacion.ID" >
                                <td>
                                    <button type="button" @click="abrirModal('delegacion', 'actualizar', delegacion)" class="btn btn-warning btn-sm" >
                                        <i class="icon-pencil"></i>
                                    </button> &nbsp;
                                    <button type="button" @click="abrirModal('delegacion', 'informacion', delegacion)" class="btn btn-info btn-sm" >
                                        <i class="icon-eye"></i>
                                    </button>                                            
                                    <button type="button" class="btn btn-danger btn-sm" @click="eliminarDelegacion(delegacion.ID)" >
                                        <i class="icon-trash"></i>
                                    </button>                                            
                                </td>
                                
                                <td v-text="delegacion.SLUG"></td>
                                <td v-text="delegacion.SEDE"></td>
                                <td v-text="delegacion.NIVEL_EDUCATIVO"></td>
                                <td v-text="delegacion.REGION"></td>
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
                                <label class="col-md-3 form-control-label" for="text-input">Nomenclatura</label>
                                <div class="col-md-9">
                                    <select v-model="nomenclatura" class="form-control" :disabled="desabilitar == 1">
                                        <option disabled value="" selected="selected">Selecciona...</option>
                                        <option v-for="nom in arrayNomenclaturas" :key="nom.id" v-bind:value="nom.id" >
                                            {{nom.nomenclatura}}
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input" >Número</label>
                                <div class="col-md-9">
                                    <input type="tel" v-model="num_deleg" class="form-control" placeholder="Número de la Delegación" :disabled="desabilitar == 1">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Sede</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="sede" class="form-control" placeholder="Sede Delegacional" style="text-transform: uppercase;" :disabled="desabilitar == 1">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Nivel Educativo</label>
                                <div class="col-md-9">
                                     <select v-model="nivel" class="form-control" :disabled="desabilitar == 1">
                                        <option disabled value="" selected="selected">Selecciona...</option>
                                        <option v-for="niv in arrayNiveles" :key="niv.id" v-bind:value="niv.id" >
                                            {{niv.nivel_educativo}}
                                        </option>
                                    </select>                                   
                                </div>
                            </div>                                                        

                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Región</label>
                                <div class="col-md-9">
                                     <select v-model="region" class="form-control" :disabled="desabilitar == 1">
                                        <option disabled value="" selected="selected">Selecciona...</option>
                                        <option v-for="region in arrayRegiones" :key="region.id" v-bind:value="region.id" >
                                            {{region.nombre}} - {{region.sede}}
                                        </option>
                                    </select>  
                                </div>
                            </div>

                            <div v-show="erroDelegacion" class="form-group row div-error">
                                <div class="col-md-9 text-error">
                                    <div v-for="error in errorMsgDelegacion" :key="error" v-text="error" >

                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                        <button type="button" v-if="btnAccion == 1" class="btn btn-primary" @click="registrarDelegacion()">Guardar</button>
                        <button type="button" v-if="btnAccion == 2" class="btn btn-primary" @click="actualizarDelegacion()" >Actualizar</button>
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
                delegacion_id : 0,

                nomenclatura : '',
                num_deleg : '',
                sede : '',
                nivel : '',
                region : '',

                arrayNomenclaturas : [],
                arrayNiveles : [],
                arrayRegiones : [],
                arrayDelegacion : [],

                modal : 0,
                tituloModal : '',
                btnAccion : 0,
                erroDelegacion : 0,
                errorMsgDelegacion : [],
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
                criterio : 'slug',
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
            listarDelegacion(page,buscar,criterio) {
                let me=this;
                var url = '/admin/delegaciones?page='+page+'&buscar='+buscar+'&criterio='+criterio;
                axios.get(url).then(function (response) {
                        var respuesta = response.data;
                        me.arrayDelegacion = respuesta.delegaciones.data;
                        me.pagination = respuesta.pagination;
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    });
            },
            listarNomenclaturas(){
                let me=this;
                var url ='/admin/nomenclaturas/';
                axios.get(url).then(function (response){
                        var respuesta = response.data;
                        me.arrayNomenclaturas = respuesta.nomenclaturas.data;
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    });
            },
            listarNiveles(){
                let me=this;
                var url ='/admin/niveles/';
                axios.get(url).then(function (response){
                        var respuesta = response.data;
                        me.arrayNiveles = respuesta.niveles.data;
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    });
            },      
            listarRegiones(){
                let me=this;
                var url ='/admin/regiones/';
                axios.get(url).then(function (response){
                        var respuesta = response.data;
                        me.arrayRegiones = respuesta.regiones.data;
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    });
            },                    
            cambiarPagina(page,buscar,criterio) {
                let me = this;
                me.pagination.current_page = page;
                me.listarDelegacion(page,buscar,criterio);
            },
            registrarDelegacion() {
                if (this.validarDelegacion()) {
                    return;
                }
                let me=this;
                axios.post('/admin/delegacion/registrar',{
                    'nomenclatura_id' : this.nomenclatura,
                    'numero' : this.num_deleg,
                    'sede' : this.sede,
                    'nivel_id' : this.nivel,
                    'region_id' : this.region,                    
                }).then(function (response) {
                        me.cerrarModal();
                        me.listarDelegacion(1,'','slug');
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    });
            },
            actualizarDelegacion() {
                
                if (this.validarDelegacion()) {
                    return;
                }
                let me=this;
                axios.put('/admin/delegacion/actualizar/',{
                    'nomenclatura_id' : this.nomenclatura,
                    'numero' : this.num_deleg,
                    'sede' : this.sede,
                    'nivel_id' : this.nivel,
                    'region_id' : this.region,   
                    'id' : this.delegacion_id
                }).then(function (response) {
                        me.cerrarModal();
                        me.listarDelegacion(1,'','slug');
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    });
            },
            eliminarDelegacion(ID){
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
                        axios.delete('/admin/delegacion/eliminar/'+ID)
                        .then(function (response) {
                            me.listarDelegacion(1,'','slug');
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
            validarDelegacion(){
                this.erroDelegacion=0;
                this.errorMsgDelegacion = [];

                if (!this.nomenclatura) this.errorMsgDelegacion.push("El campo nomenclatura no puede estar vacío");
                if (!this.num_deleg) this.errorMsgDelegacion.push("El campo sede necesita un número delegacional");
                if (!this.sede) this.errorMsgDelegacion.push("Es necesario un nombre de sede");
                if (!this.nivel) this.errorMsgDelegacion.push("El campo nivel no puede estar vacio");
                if (!this.region) this.errorMsgDelegacion.push("El campo región no puede estar vacio");
                if (this.errorMsgDelegacion.length) this.erroDelegacion = 1;
                return this.erroDelegacion;
            },
            cerrarModal() {
                this.tituloModal = '';
                this.modal = 0;
                this.delegacion_id = '';
                this.nomenclatura = '';
                this.num_deleg = '';
                this.sede = '';
                this.nivel = '';
                this.region = '';
                this.desabilitar = 0;
            },
            abrirModal(modelo, accion, data = []) {
                switch (modelo) {
                    case "delegacion": {
                        switch (accion) {
                            case "registrar": {
                                this.tituloModal = 'Nueva Delegación';
                                this.modal = 1;
                                this.nomenclatura = '';
                                this.num_deleg = '';
                                this.sede = '';
                                this.nivel = '';
                                this.region = '';
                                this.btnAccion = 1;
                                break;                               
                            }

                            case "actualizar": {
                                this.delegacion_id = data['ID'];
                                this.tituloModal = 'Actualizar Delegación';
                                this.modal = 1;
                                this.nomenclatura = data['NOMENCLATURA_ID'];
                                this.num_deleg = data['NUMERO_DELEGACIONAL'];
                                this.sede = data['SEDE'];
                                this.nivel = data['NIVEL_ID'];
                                this.region = data['REGION_ID'];
                                this.btnAccion = 2;
                                break;                               
                            }

                            case "informacion": {
                                this.delegacion_id = data['ID'];
                                this.tituloModal = 'Mostrar información de la delegacion';
                                this.modal = 1;
                                this.nomenclatura = data['NOMENCLATURA_ID'];
                                this.num_deleg = data['NUMERO_DELEGACIONAL'];
                                this.sede = data['SEDE'];
                                this.nivel = data['NIVEL_ID'];
                                this.region = data['REGION_ID'];
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
            this.listarDelegacion(1,this.buscar, this.criterio);
            this.listarNomenclaturas();
            this.listarNiveles();
            this.listarRegiones();
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
