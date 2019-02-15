<template>
    <div>
        <div class="container">
            <div class="row">
                <router-link v-if="$store.state.token" class="waves-effect waves-light btn" to="/companies">Companies
                </router-link>
                <router-link v-if="$store.state.token" class="waves-effect waves-light btn" to="/employees">Employees
                </router-link>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "MainPage.vue"
    }
</script>

<style scoped>

</style>
