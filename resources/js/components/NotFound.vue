<template>
    <div class="hello">
        <section class="services page-404">
            <div class="title">Страница не найдена</div>
            <div class="description">Вы перешли по несуществующей ссылке. <p>Вернитесь на <router-link to="/"><a>главную</a></router-link> страницу</p></div>
        </section>
    </div>
</template>

<script>
    export default {
        name: 'NotFound',
        data() {
            return {
                msg: 'Welcome to Your Vue.js App',

            }
        },
    }
</script>

<style lang="scss" scoped>
    .services.page-404:before {
        width: 58%;
    }
</style>

