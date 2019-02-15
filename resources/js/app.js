/**
 * First, we will load all of this project's Javascript utilities and other
 * dependencies. Then, we will be ready to develop a robust and powerful
 * application frontend using useful Laravel and JavaScript libraries.
 */

require('./bootstrap')
require('materialize-css')
require('materialize-css/dist/css/materialize.min.css')

window.Vue = require('vue')
window.Vuex = require('vuex')
window.$ = require('jquery')
window.dt = require( 'datatables.net' )
window.qs = require('querystring')

import router from '../router'

Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {
        token: localStorage.getItem('token') ? localStorage.getItem('token') : false,
        user: null
    },
    mutations: {
        setToken(state, value) {
            state.token = value;
            localStorage.setItem('token', value);
            router.push('/')
        },
        loggedOut(state) {
            state.token = false;
            state.user = null;
            localStorage.removeItem('token')
            router.push('/login')
        },
        setUser(state, value) {
            state.user = value;
        },
    },
    actions: {
        authenticate({commit}, data) {
            return new Promise((resolve, reject) => {
                axios.post('login', {
                        email: data.email,
                        password: data.password
                    })
                    .then(function (response) {

                        let bearer_token = response.data.success.token;

                        commit('setToken', bearer_token);

                        resolve(response)

                    }).catch(function (error) {
                    reject(error)
                });
            })
        },
        getUser({commit}) {
            axios.post('detail', {
                    email: data.email,
                    password: data.password
                }, {
                    headers: {Authorization: state.token}
                })
                .then(function (response) {
                    let user = response.data.success;
                    commit('setUser', user)
                }).catch(function (error) {
                console.log(error)
            });
        },
        logout({commit}) {
            commit('loggedOut')
        },
    }
});

const app = new Vue({
    router,
    store,
    el: '#app'
});
