<template>
    <div class="container" >
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
                facturas : []
            }
        },
        created(){
            this.getFacturas();
        },
        methods:{
            tabla(){
                this.$nextTick(()=>{
                    $('#example').DataTable();
                })
            } ,
            getFacturas(){
                axios.get('listarFacturas').then(res=>{
                    this.facturas = res.data;
                    this.tabla();
                })
            }              
        }
    }
</script>