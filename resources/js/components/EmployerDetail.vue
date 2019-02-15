<template>
    <div>
        <h1>employer</h1>

        <div class="row">
            <form class="col s12" v-if="isLoaded" v-on:submit.prevent="onSubmit">
                <div class="row">
                    <div class="input-field col s6">
                        <input placeholder="Placeholder" :class="{'invalid':errors}" id="first_name"
                               v-model="employer.first_name" type="text"
                               class="validate">
                        <label for="first_name">First Name</label>
                    </div>

                    <div class="input-field col s6">
                        <input placeholder="Placeholder" :class="{'invalid':errors}" id="last_name"
                               v-model="employer.last_name" type="text"
                               class="validate">
                        <label for="first_name">Last Name</label>
                    </div>

                    <div class="input-field col s6">
                        <input id="email" :class="{'invalid':errors}" type="email" v-model="employer.email"
                               class="validate">
                        <label for="email">Email</label>
                    </div>

                    <div class="input-field col s6">
                        <input id="phone" :class="{'invalid':errors}" type="text" v-model="employer.phone"
                               class="validate">
                        <label for="phone">Phone</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <input id="company_id" :class="{'invalid':errors}" type="text" v-model="employer.company_id"
                               class="validate">
                        <label for="company_id">Company ID</label>
                    </div>
                </div>

                <button class="btn waves-effect waves-light" type="submit" name="action">Submit
                    <i class="material-icons right">send</i>
                </button>

            </form>
        </div>

    </div>
</template>

<script>
    export default {
        name: "EmployerDetail.vue",
        data: function () {
            return {
                isLoaded: false,
                employer: null,
                errors: false
            }
        },

        beforeRouteEnter(to, from, next) {
            next(vm => {
                vm.getData();
            })
        },

        beforeRouteUpdate(to, from, next) {
            this.getData();
            next()
        },

        methods: {
            getData: function () {
                this.employer = null;
                this.isLoaded = false;
                self = this;
                axios
                    .get('employee/' + this.$route.params.id, {
                        headers: {Authorization: this.$store.state.token}
                    })
                    .then(function (response) {
                        self.employer = response.data
                        self.isLoaded = true;
                    }).catch(function (error) {
                    console.log(error)
                }).then(() => {
                    M.updateTextFields();
                });
            },
            onSubmit: function () {
                self = this;
                let formData = {};

                if (this.employer.first_name)
                    formData.first_name = this.employer.first_name;

                if (this.employer.last_name)
                    formData.last_name = this.employer.last_name;

                if (this.employer.phone)
                    formData.phone = this.employer.phone;

                if (this.employer.email)
                    formData.email = this.employer.email;

                if (this.employer.company_id)
                    formData.company_id = this.employer.company_id;

                axios.put('employee/' + this.$route.params.id, qs.stringify(formData), {
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                        'Authorization': this.$store.state.token
                    }
                })
                    .then(function (response) {
                        self.errors = false
                        self.employer = response.data
                    }).catch(function (error) {
                    self.errors = true

                    console.log(error)
                });
            },
        }

    }
</script>

<style scoped>

</style>
