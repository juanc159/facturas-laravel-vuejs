<template>
    <div class="container" >
        <div class="row">
            <div class="col-3">
                <form @submit.prevent='guardarFactura()'>
                    <div ><h3>Agregar Factura</h3> </div>
                        <div ><input type="text" class="form-control mb-2" placeholder="Emisor" v-model="factura.idEmisor"></div>
                        <div ><input type="text" class="form-control mb-2" placeholder="Comprador" v-model="factura.idComprador"></div>
                        <div ><input type="number" class="form-control mb-2" placeholder="IVA" v-model="factura.iva"></div>
                        <div ><button class="btn btn-success">Guardar factura</button></div>
                </form>
            </div>
            <div class="col-7">
                <form @submit.prevent='agregarProducto'>
                    <div ><h3>Agregar Productos</h3> </div>
                    <div class="row">
                        <div class="col-md-4">Producto: <input type="text" class="form-control mb-2" placeholder="Producto" v-model="producto.idProducto"></div>
                        <div class="col-md-4">Cantidad: <input type="number" class="form-control mb-2" placeholder="Cantidad" v-model="producto.cantidadProducto"></div>
                        <div class="col-md-2">Valor: <input type="number" class="form-control mb-2" placeholder="Valor Unitario" v-model="producto.valorUnitario"></div>
                        <div class="col-md-2"><button class="btn btn-primary">Agregar producto</button></div>
                    </div>
                </form>
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                        <th scope="col">Producto</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Valor unitario</th>
                        <th scope="col">Valor Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in productos" :key="index">
                            <th>{{item.idProducto}} </th>
                            <th>{{item.cantidadProducto}} </th>
                            <th>{{item.valorUnitario}} </th>
                            <th>{{item.valorTotal}} </th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        
        <hr class="mt-3"> 
        
        <hr>
        
        
    </div>
</template>

<script>
    export default {
        data() {
            return {
                editarActivo: false,
                precio: 0,
                sumatoria:0,
                productos:[],
                producto: {
                    idProducto: '',
                    cantidadProducto: 0,
                    valorUnitario:0,
                    valorTotal:0
                },
                factura: {
                    idFactura: '',
                    idEmisor: '',
                    idComprador: '',
                    valorFactura: 0,
                    iva: 12, //valor constante del iva
                    valorFinal: 0,
                }
            }
        },
        created(){
        },
        methods:{    
            guardarFactura(){
                if(this.factura.idEmisor <= 0 || this.factura.idComprador <= 0  || this.factura.iva <= 0){
                    alert('Debes completar todos los campos antes de guardar');
                    return;
                }
                this.factura.valorFinal= this.sumatoria + (this.sumatoria * this.factura.iva /100);
                
                const parametros = {
                    idEmisor: this.factura.idEmisor,
                    idComprador: this.factura.idComprador,
                    iva: this.factura.iva,
                    valorFactura: this.sumatoria,
                    valorFinal :this.factura.valorFinal,
                    productos: this.productos
                };                
                
                
                axios.post('facturas',parametros)
                    .then(res => {
                        console.log('exito');
                        this.factura.idEmisor = '';
                        this.factura.idComprador = '';
                        this.factura.iva = '';
                        this.factura.valorFinal = '';
                        this.productos='';
                    });
            },      
            agregarProducto(){
                if(this.producto.idProducto.trim() === '' || this.producto.cantidadProducto <= 0 || this.producto.valorUnitario <= 0 ){
                    alert('Revise los campos que desea Guardar');
                    return;
                }
                this.precio= this.producto.valorUnitario * this.producto.cantidadProducto;
                this.producto.valorTotal = this.precio;
                
                const parametros = {
                    idProducto: this.producto.idProducto,
                    cantidadProducto: this.producto.cantidadProducto,
                    valorUnitario: this.producto.valorUnitario,
                    valorTotal: this.producto.valorTotal
                };
                this.productos.push(parametros);
                this.sumatoria = 0;
                this.productos.forEach(element => {
                    this.sumatoria = this.sumatoria + element.valorTotal ;
                });
                console.log(this.sumatoria);
                this.producto.idProducto = '';
                this.producto.cantidadProducto = '';
                this.producto.valorUnitario = '';
                this.producto.valorTotal = '';
                
            },
        }
    }
</script>
