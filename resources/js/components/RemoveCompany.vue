<template>
    <div>

    </div>
</template>

<script>
    export default {
        name: "RemoveCompany.vue",
        beforeRouteEnter(to, from, next) {
            next(vm => {
                axios({
                    method: 'delete',
                    url: 'company/' + to.params.id,
                    data: null,
                    headers: {'Content-Type': 'application/json', 'Authorization': vm.$store.state.token}
                })
                    .then(function (response) {
                        vm.$router.push('/')
                    }).catch(function (error) {
                    console.log(error)
                });
            })
        }

    }
</script>

<style scoped>

</style>
