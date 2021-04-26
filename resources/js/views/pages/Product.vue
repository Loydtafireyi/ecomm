<template>
    <div class="grid h-screen bg-gray-100 place-items-center">
  <section class="flex flex-col w-3/4 px-5 py-10 bg-white rounded-md shadow-lg md:flex-row gap-11 md:max-w-2xl">
    <div class="flex flex-col justify-between text-indigo-500">
      <img src="https://images.stockx.com/Nike-Epic-React-Flyknit-2-White-Pink-Foam-W-Product.jpg?fit=fill&bg=FFFFFF&w=700&h=500&auto=format,compress&q=90&dpr=2&trim=color&updated_at=1603481985" alt="" />
    </div>
    <div class="text-indigo-500">
      <small class="uppercase">Category</small>
      <h3 class="text-2xl font-medium text-black uppercase">{{ product.name }}</h3>
      <h3 class="text-2xl font-semibold mb-7">
          <span class="text-red-700 line-through">${{ product.price_before }}</span>
          ${{ product.price }}
      </h3>
      <small class="text-black">{{ product.description }}</small>
      <div class="flex gap-0.5 mt-4">
        <button @click="order" id="addToCartButton" class="px-8 py-3 text-white uppercase transition bg-indigo-600 hover:bg-indigo-500 focus:outline-none">Confirm Order</button>
        <!-- <button id="likeButton" class="p-3 text-white uppercase transition bg-indigo-600 hover:bg-indigo-500 focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-suit-heart-fill" viewBox="0 0 16 16">
                <path d="M4 1c2.21 0 4 1.755 4 3.92C8 2.755 9.79 1 12 1s4 1.755 4 3.92c0 3.263-3.234 4.414-7.608 9.608a.513.513 0 0 1-.784 0C3.234 9.334 0 8.183 0 4.92 0 2.755 1.79 1 4 1z"/>
            </svg>
        </button> -->
      </div>
    </div>
  </section>
</div>
</template>

<script>

export default {
    name: 'ProductView',
    created() {
        this.getProduct()
    },

    data() {
        return {
            product: '',
            slug: this.$route.params.slug
        }
    },

    methods: {
      getProduct() {
        axios.get(`/api/product/${this.$route.params.slug}`)
        .then((response) => {
            this.product = response.data.data
            console.log(response.data.data)
        })
      },
      order: function() {
            this.$store.dispatch('placeOrder', {
                slug: this.slug,
            }).then( response => {
                console.log(response)
                this.$router.push({path: '/orders'})
            }).catch(error=>{
                  console.log(error.response)
            })
        }
    }
}
</script>