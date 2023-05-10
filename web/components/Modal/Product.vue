<template>
    <b-modal v-model="show" hide-footer centered size="md">
        
        <div class="body-container">
            <b-row>
                <b-col>
                    <!-- <b-form @submit="onSubmit" @reset="onReset"> -->
                    <b-form @submit.prevent="saveInformation">
                        <b-form-group label="Title">
                            <b-form-input v-model="productData.title" placeholder="Enter title" required></b-form-input>
                        </b-form-group>
                        
                        <b-form-group label="Ingredients">
                            <b-form-textarea v-model="productData.ingredients" placeholder="Enter Ingredients" rows="3" max-rows="6"></b-form-textarea>
                        </b-form-group>
                        
                        <b-form-group label="Quantity">
                            <b-form-input v-model="productData.quantity" placeholder="Enter quantity" required></b-form-input>
                        </b-form-group>

                        <b-form-group label="Price">
                            <b-form-input v-model="productData.price" placeholder="Enter price" required></b-form-input>
                        </b-form-group>
                        
                        <b-button type="submit" class="d-block w-100" variant="primary">{{ isUpdate ? 'Update ' : 'Save ' }} product</b-button>
                    </b-form>
                </b-col>
            </b-row>

        </div>
    </b-modal>  
</template>

<script>
    export default {
        data() {
            return {
                productData: {
                    title: '',
                    price: '',
                    quantity: '',
                    ingredients: '',
                    sku: ''
                }
            }
        },
        props: {
            value: { default: false },
            isUpdate: { default: false },
            info: { default: {} }
        },
        watch: {
            isUpdate() {
                this.isForUpdateInformation()
            }
        },
        computed: {
            show: {
                get(){
                    return this.value;
                },
                set(value){
                    this.$emit('input', value);
                }
            }
        },

        methods: {
            isForUpdateInformation() {
                if (this.isUpdate) {
                    this.productData.id = this.info.id
                    this.productData.title = this.info.title
                    this.productData.ingredients = this.info.ingredients
                    this.productData.quantity = this.info.quantity
                    this.productData.price = this.info.price
                    this.productData.sku = this.info.sku
                } else {
                    this.productData.id = ''
                    this.productData.title = ''
                    this.productData.ingredients = ''
                    this.productData.quantity = ''
                    this.productData.price = ''
                    this.productData.sku = ''
                }
            }, 

            reset() {
                this.productData.title = ''
                this.productData.ingredients = ''
                this.productData.quantity = ''
                this.productData.price = ''
                this.productData.sku = ''
            },

            saveInformation() {
                this.$emit('save-product', this.isUpdate, this.productData)
                this.show = false
            }
        },

        mounted() {
            this.isForUpdateInformation()
        }
    }
</script>