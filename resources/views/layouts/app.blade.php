<!DOCTYPE html>
<html data-header-styles="light" data-menu-styles="dark" data-nav-layout="vertical" data-theme-mode="light" data-toggled="close" dir="ltr" lang="en">

<head>

    <meta charset="UTF-8">
    <meta content='width=device-width, initial-scale=1.0, user-scalable=no' name='viewport'>
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <title>@yield("title")</title>

    @yield("styles")

</head>

<body>
    @include("components.switcher")

    <div class="page">
        @include("components.header")
        @include("components.sidebar")

        <div class="main-content app-content">
            @yield("content")
        </div>

        @include("components.header-search")
        @include("components.footer")
    </div>

    @yield("scripts")
</body>
