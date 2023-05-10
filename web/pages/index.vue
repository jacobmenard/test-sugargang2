<template>
  
  <div class="product-main-container">
    <product-list>
      <template #header>

        <b-button variant="primary" class="my-3" @click="addProduct()">New entry</b-button>

        <b-row class="py-2 border">
          <b-col lg="1" class="text-center"><span>ID</span></b-col>
          <b-col lg="1" class="text-center"><span>SKU</span></b-col>
          <b-col lg="4" class="text-center"><span>Title</span></b-col>
          <b-col lg="4" class="text-center"><span>Ingredients</span></b-col>
          <b-col lg="1" class="text-center"><span>Quantity</span></b-col>
          <b-col lg="1" class="text-center"><span>Price</span></b-col>
        </b-row>
      </template>
      <template #body>
        <b-row v-for="(product, i) in products" :key="`product-${i}`" class="py-2 border product-row position-relative">
          <b-col lg="1" class="text-center"><span>{{ product.id }}</span></b-col>
          <b-col lg="1" class="text-center"><span>{{ product.sku }}</span></b-col>
          <b-col lg="3" class="text-left">
            <span>{{ product.title }}</span>
            <div class="option-container d-flex my-2" style="gap: 10px;">
              <b-button variant="primary" @click="editProduct(product, i)">Edit</b-button>
              <b-button variant="danger" @click="selectedProduct(product, i)">Delete</b-button>
            </div>
          </b-col>
          <b-col lg="5" class="text-left"><span class="truncate truncate--4">{{ product.ingredients }}</span></b-col>
          <b-col lg="1" class="text-center"><span>{{ product.quantity }}</span></b-col>
          <b-col lg="1" class="text-right"><span>{{ product.price }}</span></b-col>

        </b-row>

      </template>
    </product-list>

    <modal-delete v-model="isOpen" @delete-record="deleteProduct">
      <template #caption>
        <div class="text-center">
          <h3 class="d-block mb-3">{{ product.title }}</h3>
          <span class="font-weight-bold">Do you want do delete this product?</span>
          <br><br><br>
        </div>
      </template>
    </modal-delete>

    <modal-product v-model="isOpenEdit" :info="product" :isUpdate="isUpdate" @save-product="saveProductInfo"></modal-product>
  </div>

</template>

<style lang="scss">
  .truncate {
    word-wrap: break-word;
    -webkit-hyphens: auto;
    -ms-hyphens: auto;
    hyphens: auto;
    display: -moz-box !important;
    display: -webkit-box !important;
    -webkit-box-orient: vertical;
    box-orient: vertical;
    white-space: normal;
    overflow: hidden;
    &.truncate {
        &--4 {
            -webkit-line-clamp: 4;
            -moz-line-clamp: 4;
            line-clamp: 4;
        }
        &--3 {
            -webkit-line-clamp: 3;
            -moz-line-clamp: 3;
            line-clamp: 3;
        }
        &--2 {
            -webkit-line-clamp: 2;
            -moz-line-clamp: 2;
            line-clamp: 2;
        }
        &--1 {
            -webkit-line-clamp: 1;
            -moz-line-clamp: 1;
            line-clamp: 1;
        }
    }
}

  .product-row {

    .option-container {
      visibility: hidden;
      opacity: 0;
      transition: 0.3s;
    }

    &:hover {
      background-color: antiquewhite;
      transition: 0.3s;
      cursor: pointer;

      .option-container {
        visibility: visible;
        opacity: 1;
      }
    }
  }
</style>

<script>
import products from '@/services/products'
export default {
  // name: 'IndexPage'

  data() {
    return {
      products: [],
      isOpen: false,
      isOpenEdit: false,
      isUpdate: false,
      product: {},
      productIdx: null
    }
  },

  methods: {
    async getProducts(search) {
      await products.all({search: search}).then((res) => {
        this.products = res.data.data
        console.log(this.products)
      })
    },

    selectedProduct(product, idx) {
      this.product = product
      this.productIdx = idx
      this.isOpen = true
    },

    editProduct(product, idx) {
      var selectedProductData = product
      this.product = selectedProductData
      this.productIdx = idx
      this.isOpenEdit = true
      this.isUpdate = true
    },

    addProduct() {
      
      this.isUpdate = false
      this.isOpenEdit = true
    },

    async saveProductInfo(isUpdate, product) {
      
      console.log(isUpdate, product, this.productIdx)
      if (isUpdate) {
        await products.update(product).then((res) => {
          var result = res.data.data
          console.log(result)
          this.products[this.productIdx].title = result.title
          this.products[this.productIdx].ingredients = result.ingredients
          this.products[this.productIdx].quantity = result.quantity
          this.products[this.productIdx].price = result.price
          this.products[this.productIdx].sku = result.sku
        })
        
      } else {
        await products.add(product).then((res) => {
          this.products.push(res.data.data)
          this.products.sort((a, b) => b.id - a.id );
        })
      }
    },

    async deleteProduct() {
      await products.delete(this.product.id).then((res) => {
        debugger
        if (res.status == 200) {
          this.products.splice(this.productIdx, 1)
        }
      })
    }
  },

  mounted() {
    Promise.all([
      this.getProducts()
    ])
  }


}
</script>
