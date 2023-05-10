<template>
    <div class="product-list-container">

        <div class="product-list">
            <slot name="header"></slot>
            <slot name="body"></slot>
        </div>

        <div class="pagination-container d-flex justify-content-center my-3" style="gap: 10px;">
            <slot name="pagination"></slot>
        </div>
    </div>
</template>

<style lang="scss">
    .product-list-container {
        .product-list {
            max-width: 1366px;
            margin: auto;
        }
    }
</style>