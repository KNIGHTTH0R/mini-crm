<template>
    <div>
        <h1>New Company</h1>

        <div class="row">
            <form class="col s12" v-on:submit.prevent="onSubmit">
                <div class="row">
                    <div class="input-field col s6">
                        <input placeholder="Placeholder" id="first_name" v-model="company.name" type="text"
                               class="validate" required>
                        <label for="first_name">Name</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="email" type="email" v-model="company.email" class="validate">
                        <label for="email">Email</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <input id="website" type="text" v-model="company.website" class="validate">
                        <label for="website">Website</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <input id="logo" ref="logo" type="file" class="validate">
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
        name: "CreateCompany.vue",
        data: function () {
            return {
                company: {
                    name: null,
                    email: null,
                    website: null,
                    logo: null,
                }
            }
        },

        mounted: function(){
            M.updateTextFields();
        },

        methods: {
            onSubmit: function() {
                self = this;
                let formData = new FormData();
                if(this.company.name)
                    formData.append('name', this.company.name);

                if(this.company.email)
                    formData.append('email', this.company.email);

                if(this.company.website)
                    formData.append('website', this.company.website);
                if(this.$refs.logo.files[0])
                    formData.append('logo', this.$refs.logo.files[0]);

                axios
                    .post('company', formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data',
                            'Authorization': this.$store.state.token
                        }
                    })
                    .then(function (response) {
                        console.log(response.data.data.id)
                       self.$router.push('/company/'+response.data.data.id);

                    }).catch(function (error) {
                    console.log(error)
                });
            },
        }

    }
</script>

<style scoped>

</style>
