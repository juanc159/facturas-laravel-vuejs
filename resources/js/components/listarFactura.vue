<template>
    <div class="container" >
        <a href="facturas" class="btn btn-success mb-3">Agregar Factura</a>
              <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Fecha</th>
                <th>Emisor</th>
                <th>Comprador</th>
                <th>Valor Factura</th>
                <th>Iva</th>
                <th>Valor Final</th>
                <th >ACCIONES</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(item, index) in facturas" :key="index">
                <td>{{item.id}}</td>
                <td>{{item.fechaFactura}}</td>
                <td>{{item.idEmisor}}</td>
                <td>{{item.idComprador}}</td>
                <td>{{item.valorFactura}}</td>
                <td>{{item.iva}}</td>
                <td>{{item.valorFinal}}</td>
                <td>
                    <a :href="`facturas/${item.id}/edit`" class="btn btn-primary ml-3" > VER</a>
                    <button class="btn btn-danger" @click="eliminarFactura(item, index)"> ELIMINAR</button>
                </td>
                
            </tr>
        </tbody>
        
    </table>
                
    </div>
</template>
<script>

import datatable from 'datatables.net-bs4'
    export default {
        data() {
            return {
                facturas : [],
                compradores : [],
                emisores: []
            }
        },
        created(){
            this.cargarDatos();// CARGA EN UN ARRAY LOS COMPRADORES Y EMISORES RESGUARDADOS EN LA BASE DE DATOS
            this.getFacturas(); //CARGA TODAS LAS FACTURAS DE LA BASE DE DATOS
            
        },
        methods:{
            cargarDatos(){
                axios.get('listarEmisores').then(res=>{
                    this.emisores = res.data;//RESGUARDA EN LA VARIABLE TODOS LOS EMISORES Q ESTAN EN LA BASE DE DATOS
                }),
                axios.get('listarCompradores').then(res=>{
                    this.compradores = res.data;//RESGUARDA EN LA VARIABLE TODOS LOS COMPRADORES Q ESTAN EN LA BASE DE DATOS
                })
            },
            tabla(){//METODO PARA CARGAR LOS REGISTROS EN DATATABLE
                this.$nextTick(()=>{
                    $('#example').DataTable();
                })
            } ,
            eliminarFactura(item,index){ //ELIMINA REGISTROS TANTO EN LA TABLA DETALLE FACTURA COMO LA FACTURA
                axios.delete(`facturas/${item.id}`).then(res=>{
                    //console.log('eliminar');
                    this.facturas.splice(index, 1);//ELIMINA EL REGISTRO DEL ARRAY FACTURAS PARA Q CUNDO SE CARGUE EL DATABASE NO APARESCA
                })
            } ,
            getFacturas(){
                axios.get('listarFacturas').then(res=>{ // listatodas las facturas de la tabla factura
                    this.facturas = res.data;
                    
                    //SE RECORRE EL ARRAY FACTURAS Y DENTRO EL ARRAY EMISORES Y COMPRADORES PARA QUE MUESTRE LOS NOMBRES Y NO LOS ID
                    //ESTO ES SOLO PARA MOSTRAR NO PARA GUARDAR
                    this.facturas.forEach(element => {
                        
                        this.emisores.forEach(element1 => {
                            if(element1.id===element.idEmisor){//SI EL ELEMENTO CONINCIDE GUARDA EL NOMBRE EN LA VAIRABLE EN VEZ DEL ID
                                element.idEmisor = element1.nombreEmisor;
                            }
                        }); 
                        this.compradores.forEach(element2 => {
                            if(element2.id===element.idComprador){//SI EL ELEMENTO CONINCIDE GUARDA EL NOMBRE EN LA VAIRABLE EN VEZ DEL ID
                                element.idComprador = element2.nombreComprador;
                            }
                        });                        
                    });
                    //console.log(this.facturas); //ya 
                    this.tabla();//GENERAL EL  DATATABLE
                });
                
            }              
        }
    }
</script>