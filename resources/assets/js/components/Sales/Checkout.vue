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
                    <form id="editProductForm">
                        <div class="form-group">
                            <label for="qty">Quantity</label>
                            <input type="number" id="qty" class="form-control" ref="qty" required v-model="defaultQty">
                        </div>
                        <!--<div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" id="description" class="form-control" ref="description" required>
                        </div>-->
<!--                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" id="price" class="form-control" ref="price" required>
                        </div>-->
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" @click="resetDefault()">Close</button>
                    <button type="button" class="btn btn-success">Save</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data(){
            return {
                defaultQty: 1
            }
        },
        props: ['toCheckout'],
        methods: {
            resetDefault(){
                this.defaultQty = 1;
            }
        }
    }
</script>