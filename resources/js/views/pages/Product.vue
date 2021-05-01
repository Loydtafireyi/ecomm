<template>
    <div class="grid h-screen bg-gray-100 place-items-center">
      <section class="flex flex-col w-3/4 px-5 py-10 bg-white rounded-md shadow-lg md:flex-row gap-11 md:max-w-2xl">
        <div class="flex flex-col justify-between text-indigo-500">
          <img :src="product.image" alt="" />
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
            slug: this.$route.params.slug,
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
                console.log(response.data)
                this.$router.push({path: '/orders'})
            }).catch(error=>{
                console.log(error)
            })
        }
    }
}
</script>