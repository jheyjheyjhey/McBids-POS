<template>
    <div id="productsTable" class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">PRODUCTS</div>
            <div class="panel-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <td>Code</td>
                        <td>Description</td>
                        <td>Price</td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(product, index) in products">
                        <td>{{product.name}}</td>
                        <td>{{product.description}}</td>
                        <td>{{product.price}}</td>
                        <td>
                            <button class="btn btn-xs btn-info" type="button" data-action="edit" @click="editProduct(product, index)">Edit</button>
                            <button class="btn btn-xs btn-danger" type="button" data-action="delete" @click="deleteProduct(product)">Delete</button>
                        </td>
                    </tr>

                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="4"><span class="note">* All products are subjected to price change with prior notice.</span></td>
                    </tr>
                    </tfoot>
                </table>

                <div class="pull-right">
                    <button type="button" class="btn btn-md btn-success" data-action="add" @click="addProduct">Add New Product</button>
                </div>
            </div>
        </div>
        <edit-product-modal @updateProductTable="updateParent" :product="editProductList"></edit-product-modal>
        <add-product-modal @addNewProduct="insertToProductsTable"></add-product-modal>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                products: [],
                isEdit: false,
                product: {name:"", description:"", price:""},
                editProductList: {id: "", name:"", description:"", price:"", index:''}
            }
        },

        mounted() {
           this.fetchProducts()
        },

        methods: {
            fetchProducts(){
                axios.get('/products/all')
                    .then((response)=>{
                        if(response.status === 200){
                            this.products = _.sortBy(response.data, 'name');
                        }
                    }).catch(()=>{});
            },

            addProduct(){
                $("#addProduct").modal().show();
            },

            editProduct(product, index){
                this.editProductList.id = product.id;
                this.editProductList.name = product.name;
                this.editProductList.description = product.description;
                this.editProductList.price = product.price;
                this.editProductList.index = index;

                $("#editProduct").modal().show();
            },

            deleteProduct(product){
                if(confirm("Clicking OK will delete ["+product.name+"] - "+product.description)){
                    axios.delete('/products/'+product.id)
                        .then((response)=>{
                            if(response.status === 200){
                                this.products.splice(this.products.indexOf(product), 1);
                            }
                        }).catch((response)=>{
                            alert(response.data.error);
                    });
                }
            },

            updateParent(product){
                //replace index with new data.
                this.products.splice(product.index, 1);
                this.products.push(product);
            },

            insertToProductsTable(product){
                this.products.push(product);
            }
        }
    }
</script>