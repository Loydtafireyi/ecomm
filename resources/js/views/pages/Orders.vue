<template>
    <main class="h-full mt-5 overflow-y-auto">
          <div class="container grid px-6 mx-auto">
           
            <!-- New Table -->
            <div class="w-full overflow-hidden rounded-lg shadow-xs">
              <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                  <thead>
                    <tr
                      class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                    >
                      <th class="px-4 py-3">Product</th>
                      <th class="px-4 py-3">Amount</th>
                      <th class="px-4 py-3">Order Number</th>
                      <th class="px-4 py-3">Date</th>
                    </tr>
                  </thead>
                  <tbody
                    class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
                  >
                    <tr v-for="order in orders" class="text-gray-700 dark:text-gray-400">
                      <td class="px-4 py-3">
                        <div class="flex items-center text-sm">
                          <!-- Avatar with inset shadow -->
                          <div
                            class="relative hidden w-8 h-8 mr-3 rounded-full md:block"
                          >
                            <img
                              class="object-cover w-full h-full rounded-full"
                              src="https://dummyimage.com/200x200"
                              alt=""
                              loading="lazy"
                            />
                            <div
                              class="absolute inset-0 rounded-full shadow-inner"
                              aria-hidden="true"
                            ></div>
                          </div>
                          <div>
                            <p class="font-semibold">{{ order.product }}</p>
                          </div>
                        </div>
                      </td>
                      <td class="px-4 py-3 text-sm">
                        $ {{ order.billing_total }}
                      </td>
                      <td class="px-4 py-3 text-sm">
                        {{ order.order_number }}
                      </td>
                      <td class="px-4 py-3 text-sm">
                        {{ order.date }}
                      </td>
                    </tr>

                  </tbody>
                </table>
              </div>
              
            </div>
            
          </div>
        </main>
</template>

<script>
const default_layout = "default";


export default {
  computed: {},
  data() {
      return {
          orders: [],
      }
  },

  mounted() {
    this.loadOrders()
  },

  methods: {
    loadOrders: function() {
      axios
      .get('/api/orders', {
        headers: {
          Authorization:  'Bearer ' + this.$store.state.token,
        }
      })
      .then(response => (this.orders = response.data.data))
    }
  }
};
</script>