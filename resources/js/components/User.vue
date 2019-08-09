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
                    <i class="fa fa-align-justify"></i> Usuarios
                    <button type="button" @click="abrirModal('user','registrar')" class="btn btn-secondary">
                        <i class="icon-plus"></i>&nbsp;Nuevo
                    </button>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <select class="form-control col-md-3" v-model="criterio">
                                    <option value="name" selected="selected">Nombre</option>
                                </select>
                                <input type="text" v-model="buscar" @keyup.enter="listarUser(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                <button type="submit" @click="listarUser(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Opciones</th>
                                <th>Número</th>
                                <th>Nombre</th>
                                <th>Correo electrónico</th>
                                <th>Rol administrativo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(user, index) in arrayUser" :key="user.id" >
                                <td>
                                    <button type="button" @click="abrirModal('user', 'actualizar', user)" class="btn btn-warning btn-sm" >
                                        <i class="icon-pencil"></i>
                                    </button> &nbsp;
                                    <button type="button" @click="abrirModal('user', 'informacion', user)" class="btn btn-info btn-sm" >
                                        <i class="icon-eye"></i>
                                    </button>                                            
                                    <button type="button" class="btn btn-danger btn-sm" @click="eliminarUser(user.id)" >
                                        <i class="icon-trash"></i>
                                    </button>     
                                </td>
                                <td v-text="index+1" ></td>
                                <td v-text="user.name"></td>
                                <td v-text="user.email"></td>
                                <td v-text="user.rol"></td>
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
                                    <input type="text" v-model="name" class="form-control" placeholder="Ingresa el nombre completo" :disabled="desabilitar == 1">
                                    <span class="error text-error " v-if="errors.name" v-text="errors.name[0]"></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Correo electrónico</label>
                                <div class="col-md-9">
                                    <input type="email" v-model="email"  class="form-control" placeholder="¿Cúal es su correo electrónico?" :disabled="desabilitar == 1">
                                    <span class="error text-error " v-if="errors.email" v-text="errors.email[0]"></span>
                                </div>
                            </div>                                                        

                            <div class="form-group row" v-if="hidePass == 0">
                                <label class="col-md-3 form-control-label" for="text-input" >Contraseña</label>
                                <div class="col-md-9">
                                    <input type="password" v-model="password" class="form-control" :disabled="desabilitar == 1">
                                    <span class="error text-error " v-if="errors.password" v-text="errors.password[0]"></span>                                    
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Su slug</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="slug" class="form-control" placeholder="slug de url" :disabled="desabilitar == 1">
                                    <span class="error text-error " v-if="errors.slug" v-text="errors.slug[0]"></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Rol de sistema</label>
                                <div class="col-md-9">
                                    <select v-model="rol" class="form-control" :disabled="desabilitar == 1">
                                        <option disabled value="" selected="selected">Selecciona...</option>
                                        <option v-for="rol in arrayRol" :key="rol.id" v-bind:value="rol.id" >
                                            {{rol.nombre}}
                                        </option>
                                    </select>
                                    <span class="error text-error " v-if="errors.rol" v-text="errors.rol[0]" ></span>
                                </div>
                            </div>

                            <div v-show="errorUser" class="form-group row div-error">
                                <div class="col-md-9 text-error">
                                    <div v-for="error in errorMsgUser" :key="error" v-text="error" >

                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                        <button type="button" v-if="btnAccion == 1" class="btn btn-primary" @click="registrarUser()">Guardar</button>
                        <button type="button" v-if="btnAccion == 2" class="btn btn-primary" @click="actualizarUser()" >Actualizar</button>
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
                user_id : 0,
                name : '',
                email : '',
                slug : '',
                password : '', 

                arrayRol : [],
                rol : 0,

                arrayUser : [],
                modal : 0,
                tituloModal : '',
                btnAccion : 0,
                errorUser : 0,
                errorMsgUser : [],
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
                criterio : 'name',
                buscar : '',
                desabilitar: 0,
                hidePass : 0,
                errors : []
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
            listarUser(page,buscar,criterio) {
                let me=this;
                var url = '/admin/users?page='+page+'&buscar='+buscar+'&criterio='+criterio;
                axios.get(url).then(function (response) {
                        var respuesta = response.data;
                        me.arrayUser = respuesta.users.data;
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
            listarRol(){
                let me = this;
                var url = '/admin/roles';
                axios.get(url).then(function (response){
                    var respuesta = response.data;
                    me.arrayRol = respuesta.roles.data;                    
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            cambiarPagina(page,buscar,criterio) {
                let me = this;
                me.pagination.current_page = page;
                me.listarUser(page,buscar,criterio);
            },
            registrarUser() {
                // if (this.validarUser()) {
                //     return;
                // }
                this.errors = [];

                let me=this;
                axios.post('/admin/user/registrar',{
                    'name' : this.name,
                    'email' : this.email,
                    'slug' : this.slug,    
                    'rol': this.rol,       
                    'password' : this.password         
                }).then(function (response) {
                        me.cerrarModal();
                        me.listarUser(1,'','name');
                    }).catch( error => {
                        if (error.response.status == 422) {
                            // console.log ("El error es : " + error);
                            this.errors = error.response.data.errors;
                        }
                    });
            },
            actualizarUser() {
                // if (this.validarUser()) {
                //     return;
                // }
                let me=this;
                axios.put('/admin/user/actualizar/',{
                    'name' : this.name,
                    'email' : this.email,
                    'slug' : this.slug,    
                    'rol': this.rol,  
                    'password' : this.password,              
                    'id' : this.user_id
                }).then(function (response) {
                        me.cerrarModal();
                        me.listarUser(1,'','name');
                    }).catch( error => {
                        if (error.response.status == 422) {
                            // console.log ("El error es : " + error);
                            this.errors = error.response.data.errors;
                        }
                    });
            },
            eliminarUser(id){
                Swal.fire({               
                    title: '¿Estás seguro?',
                    text: "¡No podrás revertir esto!"+this.name,
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
                        axios.delete('/admin/user/eliminar/'+id)
                        .then(function (response) {
                            me.listarUser(1,'','name');
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
            /*
                la validación se hace desde el controlador 

                validarUser(){
                    this.errorUser=0;
                    this.errorMsgUser = [];

                    // if (!this.nombre) this.errorMsgUser.push("El campo nombre no puede estar vacio");
                    if (!this.nombre) this.errorMsgUser.push("Es necesario que el campo nombre no este vacio");
                    if (!this.email) this.errorMsgUser.push("El campo correo es necesario");
                    if (!this.password) this.errorMsgUser.push("Se requiere una contraseña");
                    if (!this.slug) this.errorMsgUser.push("Ingresa un slug de dirección");
                    if (!this.rol) this.errorMsgUser.push("Selecciona un rol de usuario");

                    if (this.errorMsgUser.length) this.errorUser = 1;
                    return this.errorUser;
                },
            */
            cerrarModal() {
                this.tituloModal = '';
                this.modal = 0;
                this.name = '';
                this.email = '';
                this.rol = 0;
                this.desabilitar = 0;
                this.errors = [];
                this.hidePass = 0;
                this.password = '';
            },
            abrirModal(modelo, accion, data = []) {
                switch (modelo) {
                    case "user": {
                        switch (accion) {
                            case "registrar": {
                                this.tituloModal = 'Ingresar nuevo usuario';
                                this.modal = 1;
                                this.name = '';
                                this.email = '';
                                this.password = '';
                                this.slug = '';
                                this.rol = "";
                                this.btnAccion = 1;
                                break;                               
                            }

                            case "actualizar": {
                                this.user_id = data['id'];
                                this.tituloModal = 'Actualizar información de usuario';
                                this.modal = 1;
                                this.name = data['name'];
                                this.email = data['email'];
                                this.slug = data['slug'];
                                this.rol = data['rol_id'];
                                this.btnAccion = 2;
                                this.hidePass = 0;
                                break;                               
                            }

                            case "informacion": {
                                this.user_id = data['id'];
                                this.tituloModal = 'Mostrar información de usuario';
                                this.modal = 1;
                                this.name = data['name'];
                                this.email = data['email'];
                                this.slug = data['slug'];
                                this.rol = data['rol_id'];
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
            this.listarUser(1,this.buscar, this.criterio);
            this.listarRol();
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
        color: red !important;
        font-weight: normal;
    }
    .text-error input[type=text] {
        border:1px solid red;
    }
</style>
