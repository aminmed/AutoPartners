<!DOCTYPE html>
<html class="loading" lang="{{ app()->getLocale() }}" >
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <link rel="shortcut icon" href="{{asset('template/assets/img/icon.png')}}" type="image/x-icon" />
        <title>{{ $settings['title'] }}</title>


        <meta name="msapplication-TileColor" content="#1a1a1a">
        <meta name="theme-color" content="#1a1a1a">

        <link href="{{ asset('assets/css/montserrat.css') }}?v={{ config('app.version') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/opensans.css') }}?v={{ config('app.version') }}" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors.css') }}?v={{ config('app.version') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/app.css') }}?v={{ config('app.version') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/core/menu/menu-types/vertical-menu-modern.css') }}?v={{ config('app.version') }}">

        @yield('style')

        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}?v={{ config('app.version') }}">

    </head>
    @if($data['page'] == 'login')
    <body class="vertical-layout vertical-menu-modern 1-column bg-full-screen-image menu-expanded blank-page" data-open="click" data-menu="vertical-menu-modern" data-col="1-column">
    @else
    <body class="vertical-layout vertical-menu-modern 2-columns menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns" id="keyboard">

        <nav class="header-navbar navbar-expand-md navbar navbar-with-menu fixed-top navbar-semi-light bg-gradient-x-grey-blue">
            <div class="navbar-wrapper">
                <div class="navbar-header">
                    <ul class="nav navbar-nav flex-row position-relative">
                        <li class="nav-item mobile-menu d-md-none mr-auto">
                            <a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#">
                                <i class="ft-menu font-large-1"></i>
                            </a>
                        </li>
                        <li class="nav-item mr-auto">
                            <a class="navbar-brand" href="{{ route('dashboard.home') }}">
                                <img class="brand-logo" alt="{{ $settings['title'] }}" src="{{ asset('images/LogoColorNoText.jpeg') }}" width="30">
                                <h2 class="brand-text">{{ $settings['title'] }}</h2>
                            </a>
                        </li>
                        <li class="nav-item d-md-none">
                            <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile">
                                <i class="fa fa-ellipsis-v"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="navbar-container content">
                    <div class="collapse navbar-collapse" id="navbar-mobile">
                        <ul class="nav navbar-nav mr-auto float-left">
                        </ul>
                        <ul class="nav navbar-nav float-left">
                            <li class="dropdown dropdown-user nav-item">
                                <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                                    <span class="avatar avatar-online">
                                        <img src="{{ asset('images/avatar.png') }}" alt="{{ Auth::user()->name }}">
                                        <i></i>
                                    </span>
                                    <span class="user-name">{{ Auth::user()->name }}</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="{{ route('dashboard.profile.index') }}">
                                        <i class="ft-user"></i> Profil
                                    </a>
                                    <a class="dropdown-item" href="{{ route('dashboard.profile.password') }}">
                                        <i class="ft-lock"></i> changer mot de passe
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="ft-power"></i> Se déconnecter
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
            <div class="main-menu-content">
                <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                    <li class="nav-item">
                        <a href="#">
                            <i class="fa fa-dashboard"></i>
                            <span class="menu-title" data-i18n="">Admin panel</span>
                        </a>
                        <ul class="menu-content">
                            <li {{ in_array(Route::currentRouteName(), ['dashboard.home']) ? 'class=active' : '' }}>
                                <a class="menu-item" href="{{ route('dashboard.home') }}">
                                    page principal
                                </a>
                            </li>
                            <li {{ in_array(Route::currentRouteName(), ['dashboard.profile.index']) ? 'class=active' : '' }}>
                                <a class="menu-item" href="{{ route('dashboard.profile.index') }}">
                                    profil
                                </a>
                            </li>
                            <li {{ in_array(Route::currentRouteName(), ['dashboard.profile.password']) ? 'class=active' : '' }}>
                                <a class="menu-item" href="{{ route('dashboard.profile.password') }}">
                                    changer le mot de passe
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#">
                            <i class="fa fa-wrench"></i>
                            <span class="menu-title" data-i18n="">Settings</span>
                        </a>
                        <ul class="menu-content">
                            <li {{ in_array(Route::currentRouteName(), ['dashboard.settings.site']) ? 'class=active' : '' }}>
                                <a class="menu-item" href="{{ route('dashboard.settings.site') }}">
                                    Site
                                </a>
                            </li>
                            <li {{ in_array(Route::currentRouteName(), ['dashboard.settings.home']) ? 'class=active' : '' }}>
                                <a class="menu-item" href="{{ route('dashboard.settings.home') }}">
                                    Page d'accueil
                                </a>
                            </li>
                            <li {{ in_array(Route::currentRouteName(), ['dashboard.settings.services']) ? 'class=active' : '' }}>
                                <a class="menu-item" href="{{ route('dashboard.settings.services') }}">
                                Services
                                </a>
                            </li>
                            <li {{ in_array(Route::currentRouteName(), ['dashboard.settings.statistics']) ? 'class=active' : '' }}>
                                <a class="menu-item" href="{{ route('dashboard.settings.statistics') }}">
                                Statistiques 
                                </a>
                            </li>
                            <li {{ in_array(Route::currentRouteName(), ['dashboard.settings.personnel']) ? 'class=active' : '' }}>
                                <a class="menu-item" href="{{ route('dashboard.settings.personnel') }}">
                                Notre équipe 
                                </a>
                            </li>
                            <li {{ in_array(Route::currentRouteName(), ['dashboard.settings.about_us']) ? 'class=active' : '' }}>
                                <a class="menu-item" href="{{ route('dashboard.settings.about_us') }}">
                                About us 
                                </a>
                            </li>
                            <li {{ in_array(Route::currentRouteName(), ['dashboard.settings.testimonial']) ? 'class=active' : '' }}>
                                <a class="menu-item" href="{{ route('dashboard.settings.testimonial') }}">
                                Témoignages
                                </a>
                            </li>
                            <li {{ in_array(Route::currentRouteName(), ['dashboard.settings.contact']) ? 'class=active' : '' }}>
                                <a class="menu-item" href="{{ route('dashboard.settings.contact') }}">
                                 Contact
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#">
                            <i class="fa fa-users"></i>
                            <span class="menu-title" data-i18n="">Comptes</span>
                        </a>
                        <ul class="menu-content">
                            <li {{ in_array(Route::currentRouteName(), ['dashboard.users.index', 'dashboard.users.edit']) ? 'class=active' : '' }}>
                                <a class="menu-item" href="{{ route('dashboard.users.index') }}">
                                 Comptes
                                </a>
                            </li>
                            <li {{ in_array(Route::currentRouteName(), ['dashboard.users.create']) ? 'class=active' : '' }}>
                                <a class="menu-item" href="{{ route('dashboard.users.create') }}">
                                    Ajouter Compte
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#">
                            <i class="fa fa-envelope"></i>
                            <span class="menu-title" data-i18n="">Messages</span>
                        </a>
                        <ul class="menu-content">
                            <li {{ in_array(Route::currentRouteName(), ['dashboard.messages.index', 'dashboard.messages.edit']) ? 'class=active' : '' }}>
                                <a class="menu-item" href="{{ route('dashboard.messages.index') }}">
                                    Liste des messages
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#">
                            <i class="fa fa-life-ring"></i>
                            <span class="menu-title" data-i18n="">Services</span>
                        </a>
                        <ul class="menu-content">
                            <li {{ in_array(Route::currentRouteName(), ['dashboard.services.index', 'dashboard.services.edit']) ? 'class=active' : '' }}>
                                <a class="menu-item" href="{{ route('dashboard.services.index') }}">
                                    Liste des services
                                </a>
                            </li>
                            <li {{ in_array(Route::currentRouteName(), ['dashboard.services.create']) ? 'class=active' : '' }}>
                                <a class="menu-item" href="{{ route('dashboard.services.create') }}">
                                   Ajouter service
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#">
                            <i class="fa fa-image"></i>
                            <span class="menu-title" data-i18n="">Sliders</span>
                        </a>
                        <ul class="menu-content">
                            <li {{ in_array(Route::currentRouteName(), ['dashboard.sliders.index', 'dashboard.sliders.edit']) ? 'class=active' : '' }}>
                                <a class="menu-item" href="{{ route('dashboard.sliders.index') }}">
                                    Liste des sliders
                                </a>
                            </li>
                            <li {{ in_array(Route::currentRouteName(), ['dashboard.sliders.create']) ? 'class=active' : '' }}>
                                <a class="menu-item" href="{{ route('dashboard.sliders.create') }}">
                                    Ajouter Slider
                                </a>
                            </li>
                        </ul>
                    </li> 
                    <li class="nav-item">
                        <a href="#">
                            <i class="fa fa-id-card-o"></i>
                            <span class="menu-title" data-i18n="">Témoignages </span>
                        </a>
                        <ul class="menu-content">
                            <li {{ in_array(Route::currentRouteName(), ['dashboard.testimonial.index', 'dashboard.testimonial.edit']) ? 'class=active' : '' }}>
                                <a class="menu-item" href="{{ route('dashboard.testimonial.index') }}">
                                     Liste des témoignages
                                </a>
                            </li>
                            <li {{ in_array(Route::currentRouteName(), ['dashboard.testimonial.create']) ? 'class=active' : '' }}>
                                <a class="menu-item" href="{{ route('dashboard.testimonial.create') }}">
                                     Ajouter témoignage
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#">
                            <i class="fa fa-industry"></i>
                            <span class="menu-title" data-i18n="">Fabricants</span>
                        </a>
                        <ul class="menu-content">
                            <li {{ in_array(Route::currentRouteName(), ['dashboard.fabricants.index', 'dashboard.fabricants.edit']) ? 'class=active' : '' }}>
                                <a class="menu-item" href="{{ route('dashboard.fabricants.index') }}">
                                     Liste des fabricants
                                </a>
                            </li>
                            <li {{ in_array(Route::currentRouteName(), ['dashboard.fabricants.create']) ? 'class=active' : '' }}>
                                <a class="menu-item" href="{{ route('dashboard.fabricants.create') }}">
                                     Ajouter fabricant
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#">
                            <i class="fa fa-building"></i>
                            <span class="menu-title" data-i18n="">Catégories</span>
                        </a>
                        <ul class="menu-content">
                            <li {{ in_array(Route::currentRouteName(), ['dashboard.categories.index', 'dashboard.categories.edit']) ? 'class=active' : '' }}>
                                <a class="menu-item" href="{{ route('dashboard.categories.index') }}">
                                     Liste des catégories
                                </a>
                            </li>
                            <li {{ in_array(Route::currentRouteName(), ['dashboard.categories.create']) ? 'class=active' : '' }}>
                                <a class="menu-item" href="{{ route('dashboard.categories.create') }}">
                                     Ajouter catégorie
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#">
                            <i class="fa fa-car"></i>
                            <span class="menu-title" data-i18n="">Articles</span>
                        </a>
                        <ul class="menu-content">
                            <li {{ in_array(Route::currentRouteName(), ['dashboard.articles.index', 'dashboard.articles.edit']) ? 'class=active' : '' }}>
                                <a class="menu-item" href="{{ route('dashboard.articles.index') }}">
                                    Liste des articles
                                </a>
                            </li>
                            <li {{ in_array(Route::currentRouteName(), ['dashboard.articles.create']) ? 'class=active' : '' }}>
                                <a class="menu-item" href="{{ route('dashboard.articles.create') }}">
                                     Ajouter article
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#">
                            <i class="fa fa-users"></i>
                            <span class="menu-title" data-i18n="">Equipe</span>
                        </a>
                        <ul class="menu-content">
                            <li {{ in_array(Route::currentRouteName(), ['dashboard.personnel.index', 'dashboard.personnel.edit']) ? 'class=active' : '' }}>
                                <a class="menu-item" href="{{ route('dashboard.personnel.index') }}">
                                     Liste du personnel
                                </a>
                            </li>
                            <li {{ in_array(Route::currentRouteName(), ['dashboard.personnel.create']) ? 'class=active' : '' }}>
                                <a class="menu-item" href="{{ route('dashboard.personnel.create') }}">
                                     Ajouter membre
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#">
                            <i class="fa fa-handshake-o"></i>
                            <span class="menu-title" data-i18n="">Partenaire</span>
                        </a>
                        <ul class="menu-content">
                            <li {{ in_array(Route::currentRouteName(), ['dashboard.partners.index', 'dashboard.partners.edit']) ? 'class=active' : '' }}>
                                <a class="menu-item" href="{{ route('dashboard.partners.index') }}">
                                     Liste des partenaire
                                </a>
                            </li>
                            <li {{ in_array(Route::currentRouteName(), ['dashboard.partners.create']) ? 'class=active' : '' }}>
                                <a class="menu-item" href="{{ route('dashboard.partners.create') }}">
                                     Ajouter partenaire
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        @endif

        <div class="app-content content">
            <div class="content-wrapper">
                @if($data['page'] != 'login')
                <div class="content-header row">
                    <div class="content-header-left col-md-6 col-12 mb-2">
                        <div class="row breadcrumbs-top">
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('dashboard.home') }}" class="primary">{{ $settings['title'] }}</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        {{ $data['menu'] }}
                                    </li>
                                    @if (!empty($data['submenu']))
                                    <li class="breadcrumb-item active">
                                        {{ $data['submenu'] }}
                                    </li>
                                    @endif
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <div class="content-body">
                    @yield('content')
                </div>
            </div>
        </div>

        @if($data['page'] != 'login')
        <footer class="footer footer-static footer-light navbar-border">
            <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2">
                <span class="float-md-left d-block d-md-inline-block">
                All rights reserved © {{ date('Y') }} - {{ $settings['title'] }}
                </span>
                <span class="float-md-right d-block d-md-inline-block d-none d-lg-block">
                developed by <a href="https://www.rqaam.com" target="_black">RQAAM</a> <i class="ft-heart red"></i>
                </span>
            </p>
        </footer>
        @endif

        <script src="{{ asset('assets/vendors/js/vendors.min.js') }}?v={{ config('app.version') }}"></script>
        <script type="text/javascript">
            var HeadPosition = 'right';
            var HeadServer = 'Sorry, we could not connect to the server !!';
        </script>
        @yield('script')
        <script src="{{ asset('assets/js/core/app-menu.js') }}?v={{ config('app.version') }}"></script>
        <script src="{{ asset('assets/js/core/app.js') }}?v={{ config('app.version') }}"></script>
    </body>
</html>