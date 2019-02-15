import Vue from 'vue'
import Router from 'vue-router'
import MainPage from '../js/components/MainPage'
import Companies from '../js/components/Companies'
import Employees from '../js/components/Employees'
import CreateCompany from '../js/components/CreateCompany'
import CreateEmployer from '../js/components/CreateEmployer'
import CompanyDetail from '../js/components/CompanyDetail'
import EmployerDetail from '../js/components/EmployerDetail'
import RemoveCompany from '../js/components/RemoveCompany'
import RemoveEmployer from '../js/components/RemoveEmployer'
import Login from '../js/components/Login'
import NotFound from '../js/components/NotFound'

Vue.use(Router)

function requireAuth(to, from,  next){
    if(localStorage.getItem("token"))
    {
        next()
    }else{
        next('/login')
    }
}
export default new Router({
    routes: [
        {
            path: '/',
            name: 'Companies',
            component: Companies,
            beforeEnter: requireAuth
        },
        {
            path: '/company/:id',
            name: 'CompanyDetail',
            component: CompanyDetail,
            beforeEnter: requireAuth
        },
        {
            path: '/add-company',
            name: 'CreateCompany',
            component: CreateCompany,
            beforeEnter: requireAuth
        },
        {
            path: '/remove-company/:id',
            name: 'RemoveCompany',
            component: RemoveCompany,
            beforeEnter: requireAuth
        },

        {
            path: '/employees',
            name: 'Employees',
            component: Employees,
            beforeEnter: requireAuth
        },
        {
            path: '/employer/:id',
            name: 'EmployerDetail',
            component: EmployerDetail,
            beforeEnter: requireAuth
        },
        {
            path: '/add-employer',
            name: 'CreateEmployer',
            component: CreateEmployer,
            beforeEnter: requireAuth
        },
        {
            path: '/remove-employer/:id',
            name: 'RemoveEmployer',
            component: RemoveEmployer,
            beforeEnter: requireAuth
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
