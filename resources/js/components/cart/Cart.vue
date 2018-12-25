<template>
  <div>
    this is gaia cart component
    <cart-item v-for="item in cart.items" :key="item" :item="item"/>
  </div>
</template>

<script>
  const cart = window.pageData.cart;
  export default {
    data() {
      return {
        cart,
      }
    },
    mounted() {
      console.log('Component mounted.')
    },
  }
</script>
