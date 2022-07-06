import { createRouter, createWebHistory } from 'vue-router'

import Login from '../components/auth/Login.vue'
import MainWeb from '../components/layouts/MainWeb.vue'
import Dashboard from '../components/Web/Dashboard.vue'
import AccountSetting from '../components/Web/AccountSetting.vue'
import TradeSetting from '../components/Web/TradeSetting.vue'
import Forget from '../components/auth/Forget.vue'
import VerifyToken from '../components/auth/VerifyToken.vue'
import passwordForm from '../components/auth/NewPasswordForm.vue'
import SignUp from '../components/auth/SignUp.vue'
import MainAuth from '../components/auth/MainAuth.vue'
import CreateOffers from '../components/Web/CreateOffers.vue'
import TradeInProcess from '../components/Web/trade-in-process.vue'
import MatchRequest from '../components/Web/match-request.vue'
import MatchFound from '../components/Web/match-found.vue'
import TradeComplete from '../components/Web/trade-complete.vue'
import AddFunds from '../components/Web/AddFunds.vue'
import Verify from '../components/Web/Verify.vue'
import PageNotFound from '../components/PageNotFound.vue'
import Role from '../components/Web/Permissions/Role.vue'
import Users from '../components/Web/Permissions/Users.vue'
import addUser from '../components/Web/Permissions/AddUser.vue'
import EditRole from '../components/Web/Permissions/EditRole.vue'
import Store from "./../stores";
// import router from 'vue-router'

const routes = [
    {
        path: '',
        name: 'MainAuth',
        component: MainAuth,
        children: [
            {
                path: '',
                name: 'login',
                component: Login,
            },
            {
                path: '/sign_up',
                name: 'SignUp',
                component: SignUp,
            },
            {
                path: '/forget',
                name: 'Forget',
                component: Forget,


            },
            {
                path: '/verify-token',
                name: 'verify-token',
                component: VerifyToken

            },
            {
                path: '/password-form',
                name: 'passwordForm',
                component: passwordForm

            },
        ]
    },


    {
        path: '',
        name: 'mainweb',
        component: MainWeb,
        children: [
            {
                path: '/dashboard',
                name: 'dashboard',
                component: Dashboard

            },
            {
                path: '/account-setting',
                name: 'acount-setting.index',
                component: AccountSetting
            },
            {
                path: '/trade-setting',
                name: 'trade-setting.index',
                component: TradeSetting
            },
            {
                path: '/create-offers',
                name: 'create-offers.index',
                component: CreateOffers
            },
            {
                path: '/edit-offer/:offerId',
                name: 'edit-offers.index',
                component: CreateOffers
            },
            {
                path: '/verify/:account',
                name: 'verify',
                component: Verify
            },
            {
                path: '/trade-in-process',
                name: 'trade-in-process',
                component: TradeInProcess
            },
            {
                path: '/match-request',
                name: 'match-request',
                component: MatchRequest
            },
            {
                path: '/match-found',
                name: 'match-found',
                component: MatchFound
            },
            {
                path: '/trade-complete',
                name: 'trade-complete',
                component: TradeComplete
            },
            {
                path: '/roles',
                name: 'Role',
                component: Role
            },
            {
                path: '/users',
                name: 'users',
                component: Users
            },
            {
                path: '/add_user',
                name: 'addUser',
                component: addUser
            },
            {
                path: '/edit_user/:userId',
                name: 'edit_user',
                component: addUser
            },
            {
                path: '/edit_role/:roleId',
                name: 'edit_role',
                component: EditRole
            },
            {
                path: '/add-funds',
                name: 'AddFunds',
                component: AddFunds
            }
        ],
        meta: { requiresAuth: true }
    },
    { path: "/:pathMatch(.*)*", component: PageNotFound },

];

const router = createRouter({
    history: createWebHistory(),
    linkActiveClass: "active",
    routes
})



// middleware 

router.beforeEach((to, from, next) => {
    const requiresAuth = to.matched.some(record => record.meta.requiresAuth);
    const currentUser = Store.getters["auth/currentUser"];
    const isLoggedIn = Store.getters["auth/isLoggedIn"];
    const fromPath = from.path;

    if (isLoggedIn) {
        axios.defaults.headers.common["Authorization"] = `Bearer ${currentUser.token
            }`;
    }


    if (requiresAuth && !isLoggedIn) {
        next("/");
    } else if (
        (to.path === "/" && isLoggedIn) ||
        (to.path === "/sign_up" && isLoggedIn)
    ) {
        next("/dashboard");
    } 
     else {
        next();
    }
});

// ...

router.beforeResolve((to, from, next) => {
    // If this isn't an initial page load.
    if (to.name) {
      // Start the route progress bar.
      Startloader(true)
    }
    next()
  })
  
  router.afterEach((to, from) => {
    // Complete the animation of the route progress bar.
      Startloader(false)
  })
  

export default router;