<template>
    <div id="addProduct" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add new Product</h4>
                </div>
                <div class="modal-body">
                    <form id="editProductForm">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" class="form-control" ref="name" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" id="description" class="form-control" ref="description" required>
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" id="price" class="form-control" ref="price" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" @click="addProduct()">Save</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                _product: {id: "", name: "", description: "", price: ""}
            }
        },
        props: [],

        methods: {
            addProduct(){
                this.$data._product = {id: "", name: this.$refs.name.value, description: this.$refs.description.value, price: this.$refs.price.value};
                axios.post('/products', this.$data._product)
                    .then((response) => {
                       if(response.data.success){
                           this.$data._product.id = response.data.last_insert_id;
                           $("#addProduct").modal('toggle');
                           console.log(this.$data._product);
                           this.clearFields();
                           this.$emit('addNewProduct', this.$data._product);
                       }
                    });
            },
            clearFields(){
                this.$refs.name.value = "";
                this.$refs.description.value = "";
                this.$refs.price.value = "";
            }
        },

    }
</script>