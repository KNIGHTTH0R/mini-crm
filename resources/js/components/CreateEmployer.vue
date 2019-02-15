<template>
    <div>
        <h1>New employer</h1>

        <div class="row">
            <form class="col s12" v-on:submit.prevent="onSubmit">
                <div class="row">
                    <div class="input-field col s6">
                        <input placeholder="Placeholder" :class="{'invalid':errors}" id="first_name"
                               v-model="employer.first_name" type="text"
                               class="validate" required>
                        <label for="first_name">First Name</label>
                    </div>

                    <div class="input-field col s6">
                        <input placeholder="Placeholder" id="last_name" v-model="employer.last_name" type="text"
                               class="validate" :class="{'invalid':errors}" required>
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
                        <input id="employer_id" :class="{'invalid':errors}" type="text" v-model="employer.employer_id"
                               class="validate">
                        <label for="employer_id">Company ID</label>
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
        name: "CreateEmployer.vue",
        data: function () {
            return {
                employer: {
                    first_name: null,
                    last_name: null,
                    email: null,
                    phone: null,
                    employer_id: null,
                },
                errors: false
            }
        },

        mounted: function () {
            M.updateTextFields();
        },

        methods: {
            onSubmit: function () {
                self = this;
                let formData = new FormData();

                if (this.employer.first_name)
                    formData.append('first_name', this.employer.first_name);

                if (this.employer.last_name)
                    formData.append('last_name', this.employer.last_name);

                if (this.employer.email)
                    formData.append('email', this.employer.email);

                if (this.employer.phone)
                    formData.append('phone', this.employer.phone);

                if (this.employer.company_id)
                    formData.append('company_id', this.employer.company_id);


                axios
                    .post('employee', formData, {
                        headers: {
                            'Authorization': this.$store.state.token
                        }
                    })
                    .then(function (response) {
                        self.errors = false;
                        self.$router.push('/employer/' + response.data.id);

                    }).catch(function (error) {
                    self.errors = true;
                    console.log(error)
                });
            },
        }

    }
</script>

<style scoped>

</style>
