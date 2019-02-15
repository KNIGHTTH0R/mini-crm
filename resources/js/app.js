/**
 * First, we will load all of this project's Javascript utilities and other
 * dependencies. Then, we will be ready to develop a robust and powerful
 * application frontend using useful Laravel and JavaScript libraries.
 */

require('./bootstrap');
window.Vue = require('vue');
window.Vuex = require('vuex');

require('materialize-css');
require('materialize-css/dist/css/materialize.min.css');

import router from '../router'

Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {
        token: localStorage.getItem('token') ? localStorage.getItem('token') : false
    },
    mutations: {
        setToken(state, value) {
            state.token = value;
            localStorage.setItem('token', value);
            router.push('/')
        },
        loggedOut(state) {
            state.token = false;
            localStorage.removeItem('token')
            router.push('/login')
        },
    },
    actions: {

        authenticate({commit}, data) {
            return new Promise((resolve, reject) => {
                axios
                    .post('http://crm.my/api/login', {
                        email: data.email,
                        password: data.password
                    })
                    .then(function (response) {

                        let bearer_token = response.data.success.token;

                        commit('setToken', bearer_token)
                    }).catch(function (error) {
                    reject(error)
                });
            })
        },
        logout({commit}) {
            commit('loggedOut')
        },
    }
});


Vue.component('login', require('./components/Login.vue').default);

const app = new Vue({
    router,
    store,
    el: '#app'
});
