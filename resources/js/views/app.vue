<template>
  <div>
      <div class="container px-5 py-24 mx-auto">
        <div class="flex flex-wrap -m-4">

          <div class="p-4 md:w-1/3" v-for="product in products">
            <div class="h-full overflow-hidden border-2 border-gray-200 rounded-lg border-opacity-60">
              <img class="object-cover object-center w-full lg:h-48 md:h-36" src="https://dummyimage.com/720x400" alt="blog">
              <div class="p-6">
                <h2 class="mb-1 text-xs font-medium tracking-widest text-gray-400 title-font">CATEGORY</h2>
                <h1 class="mb-3 text-lg font-medium text-gray-900 title-font">{{ product.name }}</h1>
                <p class="mb-3 leading-relaxed">{{ product.description }}</p>
                <div class="flex flex-wrap items-center ">
                  <a class="inline-flex items-center text-indigo-500 md:mb-2 lg:mb-0">Buy Now
                    <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M5 12h14"></path>
                      <path d="M12 5l7 7-7 7"></path>
                    </svg>
                  </a>
                  <span class="inline-flex items-center py-1 pr-3 ml-auto mr-3 text-sm leading-none text-red-700 line-through border-r-2 border-gray-200 lg:ml-auto md:ml-0">
                   $ {{ product.price_before }}
                  </span>
                  <span class="inline-flex items-center text-sm leading-none text-gray-400">
                    $ {{ product.price }}
                  </span>
                </div>
              </div>
            </div>
          </div>
          
        </div>
      </div>
  </div>
</template>
<script>
const default_layout = "default";


export default {
  computed: {},
  data() {
      return {
          products: [],
      }
  },

  mounted() {
    this.loadProducts()
  },

  methods: {
    loadProducts: function() {
      axios
      .get('/api/products')
      .then(response => (this.products = response.data.data))
    }
  }
};
</script>