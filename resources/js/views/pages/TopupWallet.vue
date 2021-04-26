<template>
     <main class="h-full pb-16 overflow-y-auto">
        <div class="container grid px-6 mx-auto">

        <!-- General elements -->
        <h4
            class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300"
        >
            Topup Wallet
        </h4>
        <div
            class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800"
        >
          <form @submit.prevent="topup">
           
            <label class="block text-sm">
            <span class="text-gray-700 dark:text-gray-400">Amount</span>
            <input v-model="amount" name="amount" type="number"
                class="block w-full p-2 mt-1 text-sm border dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                placeholder="50"
                 value=""
            />
            </label>

            <button @click="topup" type="button">Topup</button>
          </form>

        </div>

        </div>
    </main>
</template>

<script>

export default {
    name: 'TopupWallet',
    
    data() {
        return {
            amount: '',
        }
    },

    methods: {
        topup: function() {
            this.$store.dispatch('walletTopup', {
                amount: this.amount,
            }).then( response => {
                this.$router.push({path: '/wallet'})
            })
        }
    }
}
</script>
