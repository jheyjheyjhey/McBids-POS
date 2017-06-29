<template>
    <div id="addProduct" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" @click="clearFields" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add new Product</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" v-show="hasError">
                        <span v-for="message in errorMessage">
                            {{(message)}}<br>
                        </span>
                    </div>
                    <form id="editProductForm" enctype="multipart/form-data" method="post">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" class="form-control" ref="name" required @keydown="resetErrorMessage">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" id="description" class="form-control" ref="description" required @keydown="resetErrorMessage">
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" id="price" class="form-control" ref="price" required @keydown="resetErrorMessage">
                        </div>

                        <div class="form-group">
                            <img class="img" :src="image" /><br>
                            <label for="photo">Image</label>
                            <input type="file" accept="image/*" class="input-file" ref="photo" name="photo" id="photo" @change="onFileChange">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" @click="clearFields" data-dismiss="modal">Close</button>
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
                _product: {id: "", name: "", description: "", price: "", photo: ""},
                image: "",
                hasError: false,
                errorMessage: []
            }
        },
        props: [],

        methods: {
            resetErrorMessage(){
                this.hasError = false;
                this.errorMessage = [];
            },
            onFileChange(e) {
                this.resetErrorMessage();
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
            },
            createImage(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.image = e.target.result;
                };
                reader.readAsDataURL(file);
            },
            addProduct(){
                this.$data._product = {id: "", name: this.$refs.name.value, description: this.$refs.description.value, price: this.$refs.price.value, photo: this.image};
                console.log(this.$refs.photo.files[0]);

                axios.post('/products', this.$data._product)
                    .then((response) => {
                       if(response.data.success){
                           this.$data._product.id = response.data.last_insert_id;
                           $("#addProduct").modal('toggle');
                           this.clearFields();
                           this.$emit('addNewProduct', this.$data._product);
                       }
                       else{
                            //error message
                           this.hasError = true;
                           this.errorMessage = response.data.error;
                       }
                    });
            },
            clearFields(){
                this.$refs.name.value = "";
                this.$refs.description.value = "";
                this.$refs.price.value = "";
                this.$refs.photo.value = "";
                this.image = "";
            }
        },

    }
</script>

<style scope>
    .img{
        width: 50%;
    }
</style>