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
                    <i class="fa fa-align-justify"></i> Delegados 
                    <button type="button" @click="abrirModal('delegado','registrar')" class="btn btn-secondary">
                        <i class="icon-plus"></i>&nbsp;Nuevo
                    </button>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <select class="form-control col-md-3" v-model="criterio">
                                    <option value="nombre" selected>Nombre</option>
                                    <option value="rfc">RFC</option>
                                    <option value="email">Email</option>
                                </select>
                                <input type="text" v-model="buscar" @keyup.enter="listarDelegado(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                <button type="submit" @click="listarDelegado(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped table-sm">

                        <thead>
                            <tr>
                                <th>Opciones</th>
                                <th> Nombre </th>
                                <th> A. paterno </th>
                                <th> A. materno </th>
                                <th> RFC </th>
                                <th> Email </th>
                                <th> Teléfono </th>
                                <th> Facebook </th>
                                <th> Twitter </th>
                                <th> Delegación </th>
                                <th> Genero </th>
                                <th> Estudios </th>
                                <th> Estado civil </th>
                                <th> Foto</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="delegado in arrayDelegado" :key="delegado.id" >
                                <td v-if="rol == 1" >
                                    <button type="button" @click="abrirModal('delegado', 'actualizar', delegado)" class="btn btn-warning btn-sm" >
                                        <i class="icon-pencil"></i>
                                    </button> &nbsp;
                                    <button type="button" class="btn btn-danger btn-sm" @click="eliminarDelegado(delegado.id)" >
                                        <i class="icon-trash"></i>
                                    </button>                                            
                                </td>
                                <td v-if="rol == 2" >
                                    <button type="button" @click="abrirModal('delegado', 'actualizar', delegado)" class="btn btn-warning btn-sm" >
                                        <i class="icon-pencil"></i>
                                    </button> &nbsp;

                                </td>
                                <td v-if="rol == 3" >
                                    <button type="button" @click="abrirModal('delegado', 'actualizar', delegado)" class="btn btn-warning btn-sm" >
                                        <i class="icon-pencil"></i>
                                    </button> &nbsp;

                                </td>


                                <td v-text="delegado.nombre"></td>
                                <td v-text="delegado.ap_paterno"></td>
                                <td v-text="delegado.ap_materno"></td>
                                <td v-text="delegado.rfc"></td>
                                <td v-text="delegado.email"></td>
                                <td v-text="delegado.telefono"></td>
                                <td v-text="delegado.facebook"></td>
                                <td v-text="delegado.twitter"></td>

                                <td v-text="delegado.delegacion"></td>
                                <td v-text="delegado.genero"></td>
                                <td v-text="delegado.maximo_estudio"></td>
                                <td v-text="delegado.estado_civil"></td>
                                <td>
                                    <img :src="'../img/img_delegados/'+delegado.imagen" class="img-thumbnail img-fluid" width="50px">
                                </td>
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
                                <div class="col-md-4 form-control-label">
                                    <label class="form-control-label" for="text-input">Región</label>
                                    <select v-model="region_id" class="form-control" id="region" name="region">
                                        <option disabled value="" selected="selected">Selecciona...</option>
                                        <option v-for="reg in arrayRegiones" :key="reg.id" v-bind:value="reg.id">{{reg.nombre}} - {{reg.sede}}</option>
                                    </select>
                                </div>
                                <div class="col-md-8 form-control-label">
                                    <label class="form-control-label" for="text-input">Delegación</label>
                                    <select v-model="delegacion" class="form-control" id="delegaciones" name="delegaciones">
                                        
                                    </select>                                
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-4 form-control-label">
                                    <label class="form-control-label" for="text-input" >Nombre</label>
                                    <input type="text" v-model="nombre" class="form-control" placeholder="Ingresa un nombre" :disabled="desabilitar == 1">
                                </div>
                                <div class="col-md-4 form-control-label">
                                    <label class="form-control-label" for="text-input" >Apellido Paterno</label>
                                    <input type="text" v-model="ap_paterno" class="form-control" placeholder="Primer apellido" :disabled="desabilitar == 1">
                                </div>

                                <div class="col-md-4 form-control-label">
                                    <label class="form-control-label" for="text-input" >Apellido Materno</label>
                                    <input type="text" v-model="ap_materno" class="form-control" placeholder="Segundo apellido" :disabled="desabilitar == 1">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 form-control-label">
                                    <label class="form-control-label" for="text-input" >Email</label>
                                    <input type="email" v-model="email" class="form-control" placeholder="Ingres un correo electrónico" :disabled="desabilitar == 1" required>
                                </div>                                
                                <div class="col-md-6 form-control-label">
                                    <label class="form-control-label" for="text-input" >RFC</label>
                                    <input type="text" v-model="rfc" class="form-control" placeholder="Ingresa tu RFC" :disabled="desabilitar == 1">
                                </div>                                
                            </div>

                            <div class="form-group row">
                                <div class="col-md-4 form-control-label">
                                    <label class="form-control-label" for="text-input">Genero</label>
                                    <select v-model="genero" class="form-control" :disabled="desabilitar == 1">
                                        <option disabled value="" selected="selected">Selecciona...</option>
                                        <option v-for="genero in arrayGeneros" :key="genero.id" v-bind:value="genero.id" v-text="genero.genero" ></option>
                                    </select> 
                                </div>   
                                <div class="col-md-4 form-control-label">
                                    <label class="form-control-label" for="text-input">Estado civil</label>
                                    <select v-model="estado_civil" class="form-control" :disabled="desabilitar == 1" >
                                        <option disabled value="" selected="selected">Selecciona...</option>
                                        <option v-for="e_civil in arrayEcivil" :key="e_civil.id" v-bind:value="e_civil.id" v-text="e_civil.estado_civil"></option>
                                    </select>
                                </div>
                                <div class="col-md-4 form-control-label">
                                    <label class="form-control-label" for="text-input">Máximo grado de estudios</label>
                                    <select v-model="max_estudios" class="form-control" :disabled="desabilitar == 1" >
                                        <option disabled value="" selected="selected">Selecciona...</option>
                                        <option v-for="estudio in arrayEstudios" :key="estudio.id" v-bind:value="estudio.id" v-text="estudio.maximo_estudio"></option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 form-control-label">                                
                                    <label class="form-control-label" for="text-input" >Teléfono</label>
                                    <input type="tel" v-model="telefono" class="form-control" placeholder="¿Cúal es tu teléfono?" :disabled="desabilitar == 1">
                                </div>

                                <div class="col-md-3 form-control-label">                                
                                    <label class="form-control-label" for="text-input" >Facebook</label>
                                    <input type="text" v-model="facebook" class="form-control" placeholder="¿Tienes facebook?" :disabled="desabilitar == 1">
                                </div>

                                <div class="col-md-3 form-control-label">                                
                                    <label class="form-control-label" for="text-input" >Twitter</label>
                                    <input type="text" v-model="twitter" class="form-control" placeholder="¿Tienes twitter?" :disabled="desabilitar == 1">
                                </div>
                            </div>


                            <div class="form-group row">
                                <div class="col-md-12 form-control-label">                                
                                    <label class="form-control-label" for="text-input" >Imagen</label>
                                    <input type="file" ref="img_delegado" @change="updateProfile" name="img_delegado" id="img_delegado" class="form-control" :disabled="desabilitar == 1">
                                </div>
                            </div>

                            <div v-show="errorDelegado" class="form-group row div-error">
                                <div class="col-md-9 text-error">
                                    <div v-for="error in errorMsgDelegado" :key="error" v-text="error" >

                                    </div>
                                </div>
                            </div>



                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                        <button type="button" v-if="btnAccion == 1" class="btn btn-primary" @click="registrarDelegado()">Guardar</button>
                        <button type="button" v-if="btnAccion == 2" class="btn btn-primary" @click="actualizarDelegado()" >Actualizar</button>
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
                delegado_id : 0,
                nombre : '',
                ap_paterno : '',
                ap_materno : '',
                rfc : '',
                email : '',
                telefono : '',
                facebook : '',
                twitter : '',


                region_id : '',
                delegacion : '',
                genero : '',
                max_estudios : '',
                estado_civil : '',

                arrayGeneros : [],
                arrayEstudios : [],
                arrayEcivil : [],
                arrayDelegado : [],
                arrayRegiones : [],

                modal : 0,
                tituloModal : '',
                btnAccion : 0,
                errorDelegado : 0,
                errorMsgDelegado : [],
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
                desabilitar: 0,
                img_delegado : '',
                rol : 0
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
            listarDelegado(page,buscar,criterio) {
                let me=this;
                var url = '/admin/delegados?page='+page+'&buscar='+buscar+'&criterio='+criterio;
                axios.get(url).then(function (response) {
                        var respuesta = response.data;
                        me.arrayDelegado = respuesta.delegados.data;
                        me.pagination = respuesta.pagination;                        
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    });
            },

            listarGeneros(){
                let me=this;
                var url ='/admin/delegados/arrayGeneros/';
                axios.get(url).then(function (response){
                        me.arrayGeneros = response.data;
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    });
            },

            listarEstudios(){
                let me=this;
                var url ='/admin/delegados/arrayEstudios/';
                axios.get(url).then(function (response){
                        me.arrayEstudios = response.data;
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    });
            },

            listarEcivil(){
                let me=this;
                var url ='/admin/delegados/arrayEcivil/';
                axios.get(url).then(function (response){
                        me.arrayEcivil = response.data;
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    });
            },

            listarRegiones(){
                let me=this;
                var url ='/admin/delegados/arrayRegiones/';
                axios.get(url).then(function (response){
                        me.arrayRegiones = response.data;
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    });

                $(document).ready(function (){
                    $("#region").change(function(){
                        var region_id = $(this).val();
                        
                        $.get('/admin/delegados/arrayDelegaciones/'+region_id,function(data){
                            $('#delegaciones').empty();
                            $('#delegaciones').append('<option disabled value="" selected="selected">Selecciona...</option>');           
                            for (var i = 0; i < data.length; ++i)
                            $('#delegaciones').append('<option value="'+ data[i].id +'">' + data[i].slug + " - " +data[i].sede +'</option>');

                            return;
                        })
                        .catch(function (error) {
                            // handle error
                            console.log(error);
                        });

                    });
                });
            },

            cambiarPagina(page,buscar,criterio) {
                let me = this;
                me.pagination.current_page = page;
                me.listarDelegado(page,buscar,criterio);
            },

            updateProfile(e){
                let me = this;
                let file = e.target.files[0];
                // console.log(file);
                let reader = new FileReader();

                if (file['size'] < 2979836) {
                    reader.onloadend = (file) => {
                        this.img_delegado = reader.result;
                    }
                    reader.readAsDataURL(file);
                } else {   
                    Swal.fire({
                        type: 'error',
                        title: 'Error...',
                        text: 'Error al subir archivo, demasiado grande en MB.'
                    })                                     
                }

            },

            registrarDelegado() {
                if (this.validarDelegado()) {
                    return;
                }
                let me=this;
                axios.post('/admin/delegado/registrar',{
                    'nombre' : this.nombre,
                    'ap_paterno' : this.ap_paterno,
                    'ap_materno' : this.ap_materno,
                    'rfc' : this.rfc,
                    'email' : this.email,
                    'telefono' : this.telefono,
                    'facebook' : this.facebook,
                    'twitter' : this.twitter,
                    'delegacion' : this.delegacion,
                    'genero' : this.genero,
                    'max_estudios' : this.max_estudios,
                    'estado_civil' : this.estado_civil,             
                    'photo' : this.img_delegado       
                }).then(function (response) {
                        me.cerrarModal();
                        me.listarDelegado(1,'','nombre');
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    });
            },

            actualizarDelegado() {
                
                if (this.validarDelegado()) {
                    return;
                }
                let me=this;
                axios.put('/admin/delegado/actualizar/',{
                    'nombre' : this.nombre,
                    'ap_paterno' : this.ap_paterno,
                    'ap_materno' : this.ap_materno,
                    'rfc' : this.rfc,
                    'email' : this.email,
                    'telefono' : this.telefono,
                    'facebook' : this.facebook,
                    'twitter' : this.twitter,
                    'delegacion' : this.delegacion,
                    'genero' : this.genero,
                    'max_estudios' : this.max_estudios,
                    'estado_civil' : this.estado_civil,
                    'id' : this.delegado_id,
                    'photo' : this.img_delegado  
                }).then(function (response) {
                        me.cerrarModal();
                        me.listarDelegado(1,'','nombre');
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    });
            },

            eliminarDelegado(id){
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
                        axios.delete('/admin/delegado/eliminar/'+id)
                        .then(function (response) {
                            me.listarDelegado(1,'','nombre');
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

            validarDelegado(){
                this.errorDelegado=0;
                this.errorMsgDelegado = [];

                // if (!this.nomenclatura) this.errorMsgDelegado.push("El campo nomenclatura no puede estar vacío");
                if (!this.delegacion) this.errorMsgDelegado.push("Es necesario que selecciones una delegación");
                if (!this.nombre) this.errorMsgDelegado.push("El campo nombre es requerido");
                if (!this.ap_paterno) this.errorMsgDelegado.push("Se necesita que ingrese el primer apellido");
                if (!this.rfc) this.errorMsgDelegado.push("El campo RFC no puede estar vacio");
                if (!this.genero) this.errorMsgDelegado.push("Selecciona un genero");
                if (!this.max_estudios) this.errorMsgDelegado.push("Selecciona un máximo grado de estudios");
                if (!this.estado_civil) this.errorMsgDelegado.push("Selecciona un estado civíl");


                if (!this.email) this.errorMsgDelegado.push("Es necesario colocar un email");
                if (this.errorMsgDelegado.length) this.errorDelegado = 1;
                return this.errorDelegado;
            },

            cerrarModal() {
                this.tituloModal = '';
                this.modal = 0;
                this.delegado_id = '';
                this.errorMsgDelegado = [];

                this.nombre = '';
                this.ap_paterno = '';
                this.ap_materno = '';
                this.rfc = '';
                this.email = '';
                this.telefono = '';
                this.facebook = '';
                this.twitter = '';

                this.delegacion = '';
                this.genero = '';
                this.max_estudios = '';
                this.estado_civil = '';
                this.region_id = '';

                this.img_delegado = '';
                $("#img_delegado").val(null);

                this.desabilitar = 0;
            },

            abrirModal(modelo, accion, data = []) {
                switch (modelo) {
                    case "delegado": {
                        switch (accion) {
                            case "registrar": {
                                this.tituloModal = 'Nuevo Delegado';
                                this.modal = 1;

                                this.nombre = '';
                                this.ap_paterno = '';
                                this.ap_materno = '';
                                this.rfc = '';
                                this.email = '';
                                this.telefono = '';
                                this.facebook = '';
                                this.twitter = '';

                                this.delegacion = '';
                                this.genero = '';
                                this.max_estudios = '';
                                this.estado_civil = '';

                                this.btnAccion = 1;

                                this.img_delegado = '';
                                break;                               
                            }

                            case "actualizar": {
                                this.delegado_id = data['id'];
                                this.tituloModal = 'Actualizar Delegado';
                                this.modal = 1;

                                this.nombre = data['nombre'];
                                this.ap_paterno = data['ap_paterno'];
                                this.ap_materno = data['ap_materno'];
                                this.rfc = data['rfc'];
                                this.email = data['email'];
                                this.telefono = data['telefono'];
                                this.facebook = data['facebook'];
                                this.twitter = data['twitter'];

                                this.delegacion = data['delegacion_id'];
                                this.genero = data['genero_id'];
                                this.max_estudios = data['estudios_id'];
                                this.estado_civil = data['estado_id'];

                                this.region_id = data['region_id'];

                                this.img_delegado = data['imagen'];

                                this.btnAccion = 2;
                                break;                               
                            }
                        }
                    }
                }
            }
        },
        mounted() {
            // console.log('Component mounted.')
            this.listarDelegado(1,this.buscar, this.criterio);
            this.listarGeneros();
            this.listarEstudios();
            this.listarEcivil();

            this.listarRegiones();
            // this.updateProfile(this.e);
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
