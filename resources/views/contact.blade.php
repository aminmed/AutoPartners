<!DOCTYPE html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--=== Favicon ===-->
    <link rel="shortcut icon" href="{{asset('template/assets/img/icon.png')}}" type="image/x-icon" />

    <title>{{$settings['title']}}</title>

    <!--=== Bootstrap CSS ===-->
    <link href="{{asset('template/assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <!--=== Slicknav CSS ===-->
    <link href="{{asset('template/assets/css/plugins/slicknav.min.css')}}" rel="stylesheet">
    <!--=== Magnific Popup CSS ===-->
    <link href="{{asset('template/assets/css/plugins/magnific-popup.css')}}" rel="stylesheet">
    <!--=== Owl Carousel CSS ===-->
    <link href="{{asset('template/assets/css/plugins/owl.carousel.min.css')}}" rel="stylesheet">
    <!--=== Gijgo CSS ===-->
    <link href="{{asset('template/assets/css/plugins/gijgo.css')}}" rel="stylesheet">
    <!--=== FontAwesome CSS ===-->
    <link href="{{asset('template/assets/css/font-awesome.css')}}" rel="stylesheet">
    <!--=== Theme Reset CSS ===-->
    <link href="{{asset('template/assets/css/reset.css')}}" rel="stylesheet">
    <!--=== Main Style CSS ===-->
    <link href="{{asset('template/style.css')}}" rel="stylesheet">
    <!--=== Responsive CSS ===-->
    <link href="{{asset('template/assets/css/responsive.css')}}" rel="stylesheet">

    <!--[if lt IE 9]>
        <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="loader-active">

    <!--== Preloader Area Start ==-->
    <div class="preloader">
        <div class="preloader-spinner">
            <div class="loader-content">
                <img src="{{asset('template/assets/img/preloader.gif')}}" alt="JSOFT">
            </div>
        </div>
    </div>
    <!--== Preloader Area End ==-->

    <!--== Header Area Start ==-->
    <header id="header-area" class="fixed-top">
        <!--== Header Top Start ==-->
        <div id="header-top" class="d-none d-xl-block">
            <div class="container">
                <div class="row">
                    <!--== Single HeaderTop Start ==-->
                    <div class="col-lg-3 text-left">
                        <i class="fa fa-map-marker"></i> {{$settings['contact']['address'] }}
                    </div>
                    <!--== Single HeaderTop End ==-->

                    <!--== Single HeaderTop Start ==-->
                    <div class="col-lg-3 text-center">
                        <i class="fa fa-mobile"></i> {{$settings['contact']['phone']}}
                    </div>
                    <!--== Single HeaderTop End ==-->

                    <!--== Single HeaderTop Start ==-->
                    <div class="col-lg-3 text-center">
                        <i class="fa fa-clock-o"></i> {{$settings['contact']['openning']}}
                    </div>
                    <!--== Single HeaderTop End ==-->

                    <!--== Social Icons Start ==-->
                    <div class="col-lg-3 text-right">
                        <div class="header-social-icons">
                        @foreach($settings['contact']['networks'] as $key => $network)
                            <a href="{{$network}}"><i class="{{'fa fa-'.$key}}"></i></a>
                        @endforeach
                        </div>
                    </div>
                    <!--== Social Icons End ==-->
                </div>
            </div>
        </div>
        <!--== Header Top End ==-->

        <!--== Header Bottom Start ==-->
        <div id="header-bottom">
            <div class="container">
                <div class="row">
                    <!--== Logo Start ==-->
                    <div class="col-lg-4">
                        <a href="{{url('/')}}" class="logo">
                            <img src="{{asset('template/assets/img/logo.png')}}" alt="JSOFT"> 
                        </a>
                    </div>
                    <!--== Logo End ==-->

                    <!--== Main Menu Start ==-->
                    <div class="col-lg-8 d-none d-xl-block">
                        <nav class="mainmenu alignright">
                            <ul>
                                <li ><a href="{{url('/')}}">Accueil</a>
                                </li>
                                <li><a href="#about-area">Qui somme nous?</a></li>
                                <li><a href="{{url('/cars')}}">Nos vehicules occasions</a></li>
                                <li><a href="{{url('/gallery')}}">Galerie</a></li>
                                <li class="active"><a href="{{url('/contact')}}">Contact</a></li>
                            </ul>
                        </nav>
                    </div>
                    <!--== Main Menu End ==-->
                </div>
            </div>
        </div>
        <!--== Header Bottom End ==-->
    </header>
    <!--== Header Area End ==-->
        <!--== Page Title Area Start ==-->
        <section id="page-title-area" class="section-padding overlay">
        <div class="container">
            <div class="row">
                <!-- Page Title Start -->
                <div class="col-lg-12">
                    <div class="section-title  text-center">
                        <h2>{{$settings['contact']['title']}}</h2>
                    </div>
                </div>
                <!-- Page Title End -->
            </div>
        </div>
    </section>
    <!--== Page Title Area End ==-->

    <!--== Contact Page Area Start ==-->
    <div class="contact-page-wrao section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 m-auto">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif
                    <div class="contact-form">
                        <form method="POST" action="{{route('submit')}}">
                        @csrf
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="name-input">
                                        <input type="text" name="name" placeholder="Votre nom - prénom">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6">
                                    <div class="email-input">
                                        <input type="email" name="email" placeholder="Adresse email">
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-lg-6 col-md-6">
                                    <div class="subject-input">
                                        <input type="text" name="subject" placeholder="objet - sujet">
                                    </div>
                                </div>
                            </div>

                            <div class="message-input">
                                <textarea name="message"  cols="30" rows="10" placeholder="Contenu"></textarea>
                            </div>

                            <div class="input-submit">
                                <button type="submit">Submit Message</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--== Contact Page Area End ==-->

    <!--== Map Area Start ==-->
    <div class="maparea">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2616.5944040923896!2d1.1518108149670576!3d49.01830089738901!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e1476a44cacccf%3A0x5d237fd793ed7a6e!2sEurorepar%20Autos%20Partners!5e0!3m2!1sfr!2sfr!4v1586550524010!5m2!1sfr!2sfr" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>  
    </div>
    <!--== Map Area End ==-->
 

    <!--== Footer Area Start ==-->
    <section id="footer-area">
        <!-- Footer Widget Start -->
        <div class="footer-widget-area">
            <div class="container">
                <div class="row">
                    <!-- Single Footer Widget Start -->
                    <div class="col-lg-4 col-md-6">
                        <div class="single-footer-widget">
                            <div class="widget-body">
                                <img src="{{asset('template/assets/img/logo.png')}}" alt="AutoPartners">
                                <p>{{$settings['description']}}</p>

                            </div>
                        </div>
                    </div>
                    <!-- Single Footer Widget End -->
                    <!-- Single Footer Widget Start -->
                    <div class="col-lg-4 col-md-6">
                        <div class="single-footer-widget">
                            <h2>Liens </h2>
                            <div class="widget-body">
                                <ul class="recent-post">
                                    <li>
                                        <a href="{{url('/cars')}}">
                                           Nos Véhicules occasions 
                                           <i class="fa fa-long-arrow-right"></i>
                                       </a>
                                    </li>
                                    <li>
                                        <a href="#about-area">
                                         Qui Somme Nous ?
                                           <i class="fa fa-long-arrow-right"></i>
                                       </a>
                                    </li>
                                    <li>
                                        <a href="service-area">
                                           Nos Services
                                           <i class="fa fa-long-arrow-right"></i>
                                       </a>
                                    </li>
                                    <li>
                                        <a href="{{url('/galerie')}}">
                                            Notre Galerie de véhicules 
                                           <i class="fa fa-long-arrow-right"></i>
                                       </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Single Footer Widget End -->
                    <!-- Single Footer Widget Start -->
                    <div class="col-lg-4 col-md-6">
                        <div class="single-footer-widget">
                            <h2>Contactez-Nous</h2>
                            <div class="widget-body">
                                <p>Autospartners, votre partenaire véhicules occasions à Evreux</p>

                                <ul class="get-touch">
                                    <li><i class="fa fa-map-marker"></i> {{$settings['contact']['address'] }}</li>
                                    <li><i class="fa fa-mobile"></i> {{$settings['contact']['phone'] }}</li>
                                    <li><i class="fa fa-envelope"></i> {{$settings['contact']['email'] }}</li>
                                </ul>
                                <a href="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2616.5944040923896!2d1.1518108149670576!3d49.01830089738901!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e1476a44cacccf%3A0x5d237fd793ed7a6e!2sEurorepar%20Autos%20Partners!5e0!3m2!1sfr!2sfr!4v1586550524010!5m2!1sfr!2sfr" class="map-show" target="_blank">montrer l'emplacement</a>
                            </div>
                        </div>
                    </div>
                    <!-- Single Footer Widget End -->
                </div>
            </div>
        </div>
        <!-- Footer Widget End -->

        <!-- Footer Bottom Start -->
        <div class="footer-bottom-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This webSite was made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://github.com/aminmed" target="_blank">Amin</a> based on template from<a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer Bottom End -->
    </section>
    <!--== Footer Area End ==-->

    <!--== Scroll Top Area Start ==-->
    <div class="scroll-top">
        <img src="{{asset('template/assets/img/scroll-top.png')}}" alt="Auto">
    </div>
    <!--== Scroll Top Area End ==-->


    <!--=======================Javascript============================-->
    <!--=== Jquery Min Js ===-->
    <script src="{{asset('template/assets/js/jquery-3.2.1.min.js')}}"></script>
    <!--=== Jquery Migrate Min Js ===-->
    <script src="{{asset('template/assets/js/jquery-migrate.min.js')}}"></script>
    <!--=== Popper Min Js ===-->
    <script src="{{asset('template/assets/js/popper.min.js')}}"></script>
    <!--=== Bootstrap Min Js ===-->
    <script src="{{asset('template/assets/js/bootstrap.min.js')}}"></script>
    <!--=== Gijgo Min Js ===-->
    <script src="{{asset('template/assets/js/plugins/gijgo.js')}}"></script>
    <!--=== Vegas Min Js ===-->
    <script src="{{asset('template/assets/js/plugins/vegas.min.js')}}"></script>
    <!--=== Isotope Min Js ===-->
    <script src="{{asset('template/assets/js/plugins/isotope.min.js')}}"></script>
    <!--=== Owl Caousel Min Js ===-->
    <script src="{{asset('template/assets/js/plugins/owl.carousel.min.js')}}"></script>
    <!--=== Waypoint Min Js ===-->
    <script src="{{asset('template/assets/js/plugins/waypoints.min.js')}}"></script>
    <!--=== CounTotop Min Js ===-->
    <script src="{{asset('template/assets/js/plugins/counterup.min.js')}}"></script>
    <!--=== YtPlayer Min Js ===-->
    <script src="{{asset('template/assets/js/plugins/mb.YTPlayer.js')}}"></script>
    <!--=== Magnific Popup Min Js ===-->
    <script src="{{asset('template/assets/js/plugins/magnific-popup.min.js')}}"></script>
    <!--=== Slicknav Min Js ===-->
    <script src="{{asset('template/assets/js/plugins/slicknav.min.js')}}"></script>

    <!--=== Mian Js ===-->
    <script src="{{asset('template/assets/js/main.js')}}"></script>

</body>

</html>