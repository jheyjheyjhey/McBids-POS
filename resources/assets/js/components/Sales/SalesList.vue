<template>
    <div id="productForSaleList">
        <div v-for="product in products" class="col-sm-4 col-md-4 mt-4 paddingBottom" @click="buyProduct(product)">
            <div class="card on-hover">
                <img class="card-img-top" src="http://success-at-work.com/wp-content/uploads/2015/04/free-stock-photos.gif">
                <div class="card-block">
                    <h5 class="card-title">{{ product.name }}</h5>
                    <div class="card-text">
                        {{ product.description }}
                    </div>
                </div>
                <div class="card-footer">
                    <b class="float-right"> {{ priceInPeso(product.price) }}</b>
                </div>
            </div>
        </div>
        <checkout-modal :toCheckout="toCheckout"></checkout-modal>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                products: [],
                toCheckout: []
            }
        },

        mounted() {
            this.fetchProducts();
        },

        methods: {
            fetchProducts(){
                axios.get('/products/all')
                    .then((response) => {
                        if (response.status === 200) {
                            this.products = response.data;
                        }
                    }).catch(() => {
                });
            },
            priceInPeso(price){
                return "PHP "+price;
            },
            buyProduct(product){
                this.toCheckout = product;
                $("#checkout").modal().toggle();
                console.log('may bumili ng '+product.name);
            }
        }
    }
</script>

<style scope>
    .paddingBottom{
        padding-bottom: 50px;
    }
</style>