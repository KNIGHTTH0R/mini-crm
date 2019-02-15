import Vue from 'vue'
import Router from 'vue-router'
import MainPage from '../js/components/MainPage'
import Login from '../js/components/Login'
import NotFound from '../js/components/NotFound'

Vue.use(Router)

export default new Router({
    routes: [
        {
            path: '/',
            name: 'MainPage',
            component: MainPage
        },
        {
            path: '/login',
            name: 'Login',
            component: Login
        },
        {
            path: '/404',
            name: '404',
            component: NotFound,
        },
        {
            path: '*',
            redirect: '/404'
        }
    ]
})
