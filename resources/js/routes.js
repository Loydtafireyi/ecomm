import Home from './views/pages/Home'
import Product from './views/pages/Product'
import Login from './views/pages/Login'
import Register from './views/pages/Register'
import Orders from './views/pages/Orders'
import Wallet from './views/pages/Wallet'
import TopupWallet from './views/pages/TopupWallet'
import Logout from './views/components/Logout'
export default{
    mode: 'history',

    routes: [
        {
            path: '/logout',
            component: Logout
        },
        {
            path: '/login',
            component: Login,
            meta: {
                requiresVisitor: true,
            }
        },
        {
            path: '/register',
            component: Register,
            meta: {
                requiresVisitor: true,
            }
        },
        {
            path: '/',
            component: Home,
        },
        {
            path: '/product/:slug',
            component: Product,
            meta: {
                requiresAuth: true,
            }
        },
        {
            path: '/orders',
            component: Orders,
            meta: {
                requiresAuth: true,
            }
        },
        {
            path: '/wallet',
            component: Wallet,
            meta: {
                requiresAuth: true,
            }
        },
        {
            path: '/wallet-topup',
            component: TopupWallet,
            meta: {
                requiresAuth: true,
            }
        }
    ]
}