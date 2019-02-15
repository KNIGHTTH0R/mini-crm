<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Mini CRM</title>
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>
<body>

<div id="app">
    <nav>
        <div class="nav-wrapper">
            <router-link tag="a" class="brand-logo" to="/">MiniCRM</router-link>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li>
                    <router-link v-if="!$store.state.token" to="/login">Login</router-link>
                </li>
                <li>
                    <a v-if="$store.state.token" v-on:click="$store.dispatch('logout')">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <router-view></router-view>
</div>
<footer class="page-footer">
    <div class="footer-copyright">
        <div class="container">
            © 2019 Copyright Text
        </div>
    </div>
</footer>

<script src="{{ (env('APP_ENV') === 'development') ? mix('js/app.js') : asset('js/app.js') }}"></script>
</body>
</html>
