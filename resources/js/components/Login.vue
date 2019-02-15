<template>
    <div>
        <main>
            <center>
                <h5 class="indigo-text">Please, login into your account</h5>
                <div class="section"></div>

                <div class="container">
                    <div class="z-depth-1 grey lighten-4 row login-form">

                        <form class="col s12" method="post" v-on:submit.prevent="authorize">
                            <div class='row'>
                                <div class='col s12'>
                                </div>
                            </div>

                            <div class='row'>
                                <div class='input-field col s12'>
                                    <input class='validate' :class="{'invalid':errors}" v-model="email" type='email'
                                           name='email' id='email'/>
                                    <label for='email'>Enter your email</label>
                                </div>
                            </div>

                            <div class='row'>
                                <div class='input-field col s12'>
                                    <input class='validate' :class="{'invalid':errors}" v-model="password" type='password' name='password'
                                           id='password'/>
                                    <label for='password'>Enter your password</label>
                                </div>
                                <span class="helper-text" v-if="errors" data-error="wrong">Credentials are incorrect</span>
                            </div>

                            <br/>
                            <center>
                                <div class='row'>
                                    <button type='submit' name='btn_login'
                                            class='col s12 btn btn-large waves-effect indigo'>Login
                                    </button>
                                </div>
                            </center>
                        </form>
                    </div>
                </div>
            </center>
        </main>
    </div>
</template>

<script>
    export default {
        name: "Login.vue",
        data() {
            return {
                email: 'admin@admin.com',
                password: 'password',
                errors: false
            }
        },
        mounted: function () {
            M.updateTextFields();
        },
        methods: {
            authorize: function () {
                self = this;
                this.$store.dispatch('authenticate', {email: this.email, password: this.password})
                    .catch(function (error) {
                        console.log(error.response)
                        self.errors = true;
                    })
            }
        },
        beforeRouteEnter (to, from, next) {
                next(vm => {
                    if((vm.$store) && vm.$store.state.token){
                        vm.$router.push('/')
                    }
                })
        }
    }
</script>

<style scoped>

</style>
