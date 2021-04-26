import axios from "axios";
import { reject } from "lodash";

export default {
    state: {
        token: null || localStorage.getItem('access_token') 
    },
    getters: {
        loggedIn(state) {
            return state.token != null
        }
    },
    mutations: {
        retrieveToken(state, token) {
            state.token = token
        },
        destroyToken(state) {
            state.token = null
        }
    },
  
    actions: {
        register(context, data){
            return new Promise((resolve, reject) => {
                axios.post('/api/register', {
                    name: data.name,
                    email: data.email,
                    password: data.password,
                    password_confirmation: data.password_confirmation,
                }).then(response => {
                    
                    console.log(response)
                  
                    resolve(response)
                }).catch(error => {
                    reject(error)
                    console.log(error)
                })
            })
          
        },

        destroyToken(context){
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.state.token
            if(context.getters.loggedIn) {
                return new Promise((resolve, reject) => {
                    axios.post('/api/logout').then(response => {
                        
                        localStorage.removeItem('access_token')
                        context.commit('destroyToken')
                        resolve(response)
                    }).catch(error => {
                        reject(error)
                        context.commit('destroyToken')
                        console.log(error)
                    })
                })
            }
          
        },

        retrieveToken(context, credentials){
            return new Promise((resolve, reject) => {
                axios.post('/api/login', {
                    username: credentials.username,
                    password: credentials.password,
                }).then(response => {
                    const token = response.data.access_token
                    localStorage.setItem('access_token', token)
                    context.commit('retrieveToken', token)
                    resolve(response)
                }).catch(error => {
                    reject(error)
                    console.log(error)
                })
            })
          
        },

        walletTopup(context, data){
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.state.token
            return new Promise((resolve, reject) => {
                axios.post('/api/topup', {
                    amount: data.amount,
                }).then(response => {
                    const data = response.data
                    console.log(data)
                    context.commit('walletTopup')
                    resolve(response)
                }).catch(error => {
                    reject(error)
                    console.log(error)
                })
            })
          
        },
        placeOrder(context, data){
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.state.token
            return new Promise((resolve, reject) => {
                axios.post('/api/checkout/' + data.slug).then(response => {
                    context.commit('placeOrder')
                    resolve(response)
                }).catch(error => {
                    reject(error)
                    console.log(error)
                })
            })
          
        }
    },
}