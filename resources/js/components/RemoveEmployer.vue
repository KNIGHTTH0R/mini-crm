<template>
    <div>

    </div>
</template>

<script>
    export default {
        name: "RemoveEmployer.vue",
        beforeRouteEnter(to, from, next) {
            next(vm => {
                axios({
                    method: 'delete',
                    url: 'employee/' + to.params.id,
                    data: null,
                    headers: {'Content-Type': 'application/json', 'Authorization': vm.$store.state.token}
                })
                    .then(function (response) {
                        vm.$router.push('/employees')
                    }).catch(function (error) {
                    console.log(error)
                });
            })
        }

    }
</script>

<style scoped>

</style>
