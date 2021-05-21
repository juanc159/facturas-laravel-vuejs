<template>
    <div class="container" >
        <a href="facturas" class="btn btn-primary mb-3">Agregar Factura</a>
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
            this.cargarDatos();
            this.getFacturas();
            
        },
        methods:{
            cargarDatos(){
                axios.get('listarEmisores').then(res=>{
                    this.emisores = res.data;
                }),
                axios.get('listarCompradores').then(res=>{
                    this.compradores = res.data;
                })
            },
            tabla(){
                this.$nextTick(()=>{
                    $('#example').DataTable();
                })
            } ,
            getFacturas(){
                axios.get('listarFacturas').then(res=>{ // listatodas las facturas de la tabla factura
                    this.facturas = res.data;
                    
                    this.facturas.forEach(element => {
                        
                        this.emisores.forEach(element1 => {//element1 = emisores
                            if(element1.id===element.idEmisor){//elemento = facturas
                                element.idEmisor = element1.nombreEmisor;
                            }
                        }); 
                        this.compradores.forEach(element2 => {
                            if(element2.id===element.idComprador){
                                element.idComprador = element2.nombreComprador;
                            }
                        });                        
                    });
                    console.log(this.facturas); //ya 
                    this.tabla();
                });
                
            }              
        }
    }
</script>