<template>
    <div id="checkout" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" @click="resetDefault()">&times;</button>
                    <h4 class="modal-title">Buy {{toCheckout.name}}</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" v-show="error">{{errorMessage}}</div>
                    <form id="editProductForm">
                        <div class="form-group">
                            <label for="qty">Quantity</label>
                            <input type="number" id="qty" class="form-control" ref="qty" required v-model.number="defaultQty" autofocus>
                        </div>
                        <br>
                        <div class="form-group-lg">
                           <div class="">
                               <h4>Total Price: <span class="text-info">{{totalPrice}}</span> </h4>
                           </div>
                        </div>
                        <br>
                        <div class="alert alert-info">
                            <span class="text-left">Reminder: Make sure that the customer paid the product before clicking <span class="btn-sm btn-success">Buy</span> button.</span>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" @click="resetDefault()">Close</button>
                    <button type="button" class="btn btn-success" @click.prevent="buy">Buy</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data(){
            return {
                defaultQty: 1,
                toBuy: [],
                price: 0,
                errorMessage: "",
                error: false

            }
        },
        props: ['toCheckout'],
        watch: {
            defaultQty(){
                if(this.defaultQty < 0){
                    this.defaultQty = 0;
                }
                this.error = false;
            }
        },
        computed: {
            totalPrice(){
                this.price = this.toCheckout.price * this.defaultQty;
                return "₱"+this.price;
            }
        },
        methods: {
            resetDefault(){
                this.price = 0;
                this.defaultQty = 1;
                this.toBuy= [];
                this.errorMessage =  "";
                this.error = false;
            },
            buy(){
                if(this.price > 0){
                    this.toBuy = {product_id: this.toCheckout.id , qty: this.defaultQty, price: this.price};
                    axios.post('/sales', this.toBuy)
                        .then((response)=>{
                            if(response.data.success){
                            }
                        });
                    this.resetDefault();
                    $("#checkout").modal('toggle');
                }
                else{
                    this.error = true;
                    this.errorMessage = "Cannot finish the transaction. Check Quantity and Price."
                }
            }
        }
    }
</script>

<style scope>

</style>