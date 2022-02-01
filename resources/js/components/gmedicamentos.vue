<template>
            <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Escritorio</a></li>
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Gestion de medicamentos
                        <button type="button" @click="abrirModal('medicamento','registrar')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <div class="card-body">
                        
                        <table id="listatabla" class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>Nombre</th>
                                    <th>Marca</th>
                                    <th>Cantidad</th>
                                    <th>Concentracion</th>
                                    <th>Tipo medicamento</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="medicamento in arraymedicamento" :key="medicamento.idgmedicamentos">
                                    <td>
                                        <button type="button" @click="abrirModal('medicamento','actualizar',medicamento)" class="btn btn-warning btn-sm">
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <template v-if="medicamento.condicion">
                                            <button type="button" class="btn btn-danger btn-sm" @click="desactivarmedicamento(medicamento.idgmedicamentos)">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </template>
                                        <template v-else>
                                            <button type="button" class="btn btn-info btn-sm" @click="activarmedicamento(medicamento.idgmedicamentos)">
                                                <i class="icon-check"></i>
                                            </button>
                                        </template>
                                    </td>
                                    <td v-text="medicamento.nombre"></td>
                                    <td v-text="medicamento.marca"></td>
                                    <td v-text="medicamento.cantidad"></td>
                                    <td v-text="medicamento.concentracion"></td>
                                    <td v-text="medicamento.tipomedicamento"></td>
                                    <td>
                                        <div v-if="medicamento.condicion">
                                            <span class="badge badge-success">Activo</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">Desactivado</span>
                                        </div>
                                        
                                    </td>
                                </tr>                                
                            </tbody>
                        </table>
                        
                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
            <!--Inicio del modal agregar/actualizar-->
            <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" v-text="tituloModal"></h4>
                            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                
                                
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="nombre" class="form-control" placeholder="Nombre del medicamento">                                        
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Marca</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="marca" class="form-control" placeholder="Marca del medicamento">                                        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Cantidad</label>
                                    <div class="col-md-9">
                                        <input type="number" v-model="cantidad" class="form-control" placeholder="">                                        
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Concentracion</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="concentracion" class="form-control" placeholder="cantidad en g o mg ej: 2 mg">
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Tipo medicamento</label>
                                    <div class="col-md-9">
                                        <select class="form-control" v-model="tipomedicamento">
                                            <option value="0" disabled>Seleccione</option>
                                            <option value="1" >Generico</option>
                                            <option value="2" >Alto costo</option>
                                        </select>                                        
                                    </div>
                                </div>
                                <div v-show="errormedicamento" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjmedicamento" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarmedicamento()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarmedicamento()">Actualizar</button>
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
        data (){
            return {
                medicamento_id: 0,
                
                nombre : '',
                marca : '',
                cantidad : 0,
                concentracion : '',
                tipomedicamento : 0,
                
                arraymedicamento : [],
                
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errormedicamento : 0,
                errorMostrarMsjmedicamento : []
    
            }
        },
        computed:{
        },
           
        methods : {
            listarmedicamento (){
                let me=this;
                var url= 'home/medicamento';
                axios.get(url).then(function (response) {
                    
                    me.arraymedicamento = response.data;

                     $(document).ready( function () {
                        $('#listatabla').DataTable();
                    } );
                    
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
           
            
            registrarmedicamento(){
                if (this.validarmedicamento()){
                    return;
                }
                
                let me = this;

                axios.post('home/medicamento/registrar',{
                    'nombre': this.nombre,
                    'marca': this.marca,
                    'cantidad': this.cantidad,
                    'concentracion': this.concentracion,
                    'tipomedicamento': this.tipomedicamento
                   
                    
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarmedicamento();
                }).catch(function (error) {
                    console.log(error);
                });
            },
            actualizarmedicamento(){
               if (this.validarmedicamento()){
                    return;
                }
                
                let me = this;

                axios.put('home/medicamento/actualizar',{
                    'nombre': this.nombre,
                    'marca': this.marca,
                    'cantidad': this.cantidad,
                    'concentracion': this.concentracion,
                    'tipomedicamento': this.tipomedicamento,
                    'idgmedicamentos': this.medicamento_id
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarmedicamento();
                }).catch(function (error) {
                    console.log(error);
                }); 
            },
            desactivarmedicamento(idgmedicamentos){
               const swalWithBootstrapButtons = Swal.mixin({
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                })

                swalWithBootstrapButtons.fire({
                title: 'Lo desea Desactivar?',
                text: "Esto se puede revertir",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Si, desactivar!',
                cancelButtonText: 'No, cancelar!',
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    swalWithBootstrapButtons.fire(
                    'Desactivado!',
                    'Tu registro ha sido desactivado.',
                    'success')
                    let me = this;

                    axios.put('home/medicamento/desactivar',{
                        'idgmedicamentos': idgmedicamentos
                    }).then(function (response) {
                        me.listarmedicamento();
                        Swal.fire(
                        'Desactivado!',
                        'El registro ha sido desactivado con éxito.',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                    'Cancelado',
                    'tu registro no ha sido desactivado',
                    'error'
                    )
                }
                })               
            },
            activarmedicamento(idgmedicamentos){
               const swalWithBootstrapButtons = Swal.mixin({
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                })

                swalWithBootstrapButtons.fire({
                title: 'Lo desea Activar?',
                text: "Esto se puede revertir",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Si, activar!',
                cancelButtonText: 'No, cancelar!',
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    swalWithBootstrapButtons.fire(
                    'Activado!',
                    'Tu registro ha sido activado.',
                    'success')
                    let me = this;

                    axios.put('home/medicamento/activar',{
                        'idgmedicamentos': idgmedicamentos
                    }).then(function (response) {
                        me.listarmedicamento();
                        Swal.fire(
                        'Activado!',
                        'El registro ha sido activado con éxito.',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                    'Cancelado',
                    'tu registro no ha sido activado',
                    'error'
                    )
                }
                })               
            },
            validarmedicamento(){
                this.errormedicamento=0;
                this.errorMostrarMsjmedicamento =[];

                if (!this.nombre) this.errorMostrarMsjmedicamento.push("El nombre del medicamento no puede estar vacío.");
                if (!this.marca) this.errorMostrarMsjmedicamento.push("La marca del medicamento no puede estar vacío.");
                
                if (!this.cantidad) this.errorMostrarMsjmedicamento.push("La cantidad del medicamento no puede estar vacío.");
                if (!this.concentracion) this.errorMostrarMsjmedicamento.push("La concentracion del medicamento no puede estar vacío.");
                if (!this.tipomedicamento) this.errorMostrarMsjmedicamento.push("El tipo del medicamento no puede estar vacío.");
              

                if (this.errorMostrarMsjmedicamento.length) this.errormedicamento = 1;

                return this.errormedicamento;
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.nombre='';
                this.marca='';
                this.cantidad = 0;                
                this.concentracion = '';
                this.tipomedicamento = 0;
                
            },
            abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "medicamento":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Registrar medicamento';
                                this.tipoAccion = 1;
                                this.nombre ='';
                                this.marca ='';
                                this.cantidad = 0;                
                                this.concentracion = '';
                                this.tipomedicamento = 0;
                                this.listarmedicamento();
                                
                                break;
                            }
                            case 'actualizar':
                            {
                               
                                this.modal=1;
                                this.tituloModal='Actualizar medicamento';
                                this.tipoAccion=2;
                                this.medicamento_id = data['idgmedicamentos'];
                                this.nombre = data['nombre'];
                                this.marca = data['marca'];
                                this.cantidad = data['cantidad'];
                                this.concentracion = data['concentracion'];
                                this.tipomedicamento = data['tipomedicamento'];
                                this.listarmedicamento();
                               
                                
                                break;
                            }
                        }
                    }
                }
               
            }
        },
        mounted() {
            this.listarmedicamento();
        }
    }
</script>
<style>    
    .modal-content{
        width: 100% !important;
        position: absolute !important;
    }
    .mostrar{
        display: list-item !important;
        opacity: 1 !important;
        position: absolute !important;
        background-color: #3c29297a !important;
    }
    .div-error{
        display: flex;
        justify-content: center;
    }
    .text-error{
        color: red !important;
        font-weight: bold;
    }
</style>
