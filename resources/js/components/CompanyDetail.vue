<template>
    <div>
        <h1>Company</h1>

        <div class="row">
            <form class="col s12" v-if="isLoaded" v-on:submit.prevent="onSubmit">
                <img class="responsive-img" width="100px" :src="company.logo">
                <div class="row">
                    <div class="input-field col s6">
                        <input placeholder="Placeholder" id="first_name" v-model="company.name" type="text"
                               class="validate">
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
        name: "CompanyDetail.vue",
        data: function () {
            return {
                isLoaded: false,
                company: null
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
                this.company = null;
                this.isLoaded = false;
                self = this;
                axios
                    .get('company/' + this.$route.params.id, {
                        headers: {Authorization: this.$store.state.token}
                    })
                    .then(function (response) {
                        self.company = response.data.data
                        self.isLoaded = true;
                    }).catch(function (error) {
                    console.log(error)
                }).then(() => {
                    M.updateTextFields();
                });
            },
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
                    .post('company/'+ this.$route.params.id +'/update', formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data',
                            'Authorization': this.$store.state.token
                        }
                    })
                    .then(function (response) {
                        self.company = response.data.data
                    }).catch(function (error) {
                    console.log(error)
                });
            },
        }

    }
</script>

<style scoped>

</style>
