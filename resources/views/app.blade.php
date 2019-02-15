<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="api-base-url" content="{{config('app.url').'api/' }}" />

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
                <li v-if="$store.state.token">
                    <router-link  to="/">{{ trans('content.companies') }}</router-link>
                </li>
                <li v-if="$store.state.token">
                    <router-link  to="/employees">{{ trans('content.employees') }}</router-link>
                </li>
                <li>
                    <router-link v-if="!$store.state.token" to="/login">{{ trans('content.login') }}</router-link>
                </li>
                <li>
                    <a v-if="$store.state.token" v-on:click="$store.dispatch('logout')">{{ trans('content.logout') }}</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <router-view></router-view>
    </div>
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
