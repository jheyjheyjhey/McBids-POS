<template>
    <div id="editProduct" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Modal Header</h4>
                </div>
                <div class="modal-body">
                    <form id="editProductForm">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" v-model="data.name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" id="description" v-model="data.description" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" id="price" v-model.number="data.price" class="form-control">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" :disabled="isSubmitting" @click="updateProduct(data)">{{updateButtonText}}</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                data: this.product,
                isSubmitting:false,
                updateButtonText: 'Update'
            }
        },
        props: ['product'],

        methods: {
            updateProduct(product){
                this.isSubmitting = true;
                this.updateButtonText = 'Updating...';

                axios.put('products/'+product.id, product)
                    .then((response)=>{
                        if(response.data.updated){
                            this.isSubmitting = false;
                            $("#editProduct").modal('toggle');
                            this.isSubmitting = false;
                            this.updateButtonText = 'Update';
                            this.$emit('updateProductTable', product);
                        }
                    })
                    .catch(()=>{
                        this.isSubmitting = false;
                        this.updateButtonText = 'Update';
                    });
            }
        },

    }
</script>