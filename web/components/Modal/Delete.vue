<template>
    <b-modal v-model="show" hide-footer centered size="md">
        
        <div class="body-container">
            <slot name="caption"></slot>

            <b-button class="d-block w-100" variant="danger" @click="deleteProduct">Delete Product</b-button>
        </div>
    </b-modal>  
</template>

<script>
    export default {
        props: {
            value: { default: false },
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
            deleteProduct() {
                this.$emit('delete-record')
                this.show = !this.show
            }
        }
    }
</script>