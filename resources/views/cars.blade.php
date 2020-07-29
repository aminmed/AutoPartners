<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--=== Favicon ===-->
    <link rel="shortcut icon" href="{{asset('template/assets/img/icon.png')}}" type="image/x-icon" />

    <title>{{$settings['title']}}</title>

    <!--=== Bootstrap CSS ===-->
    <link href="{{asset('template/assets/css/bootstrap.min.css')}}" rel="stylesheet">
        <!--=== Vegas Min CSS ===-->
        <link href="{{asset('template/assets/css/plugins/vegas.min.css')}}" rel="stylesheet">
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
                <img src="{{asset('template/assets/img/preloader.gif')}}" alt="Loader - Auto Partners">
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
                                <li><a href="{{url('/')}}">Qui somme nous?</a></li>
                                <li class="active"><a href="#">Nos vehicules</a></li>
                                <li><a href="{{url('/gallery')}}">Galerie</a></li>
                                <li><a href="{{url('/contact')}}">Contactez-Nous</a></li>
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
                        <h2>Nos Véhicules occasions</h2> <br>
                        <p>Autospartners, votre partenaire véhicules occasions à Evreux.</p>
                    </div>
                    <div class="book-ur-car">
                                    <form method="post" action="{{url('/cars')}}">
                                    @csrf
                                    <div class="pick-location bookinput-item">
                                            <select name="category" class="custom-select">
                                              <option value="0" selected>Catégorie</option>
                                              @foreach($categories as $categorie)
                                              <option value="{{$categorie->id}}">{{$categorie->name}}</option>
                                              @endforeach
                                            </select>
                                        </div>
                                        <div class="pick-location bookinput-item">
                                            <select name="fabricant" class="custom-select">
                                              <option value="0" selected>choisir la marque</option>
                                              @foreach($marques as $marque)
                                              <option value="{{$marque->id}}">{{$marque->name}}</option>
                                              @endforeach
                                            </select>
                                        </div>
                                        <div class="car-choose bookinput-item">
                                            <select class="custom-select" name="energie" id="energie">
                                              <option value="0" selected>Energie</option>
                                              <option value="Diesel" >Diesel</option>
                                                <option value="Essence" >Essence</option>
                                                <option value="Essence et GPL" >Essence et GPL</option>
                                                <option value="GPL" >GPL</option>
                                                <option value="Eléctrique" >Eléctrique</option>
                                                <option value="Hybride : Essence et électrique" >Hybride : Essence et électrique</option>
                                                <option value="Hybride : Diesel et électrique" >Hybride : Diesel et électrique</option>
                                            </select>
                                        </div>
                                        <div class="car-choose bookinput-item">
                                        <input class="custom-select" value="Prix max  £" name="prix" type="text" placeholder="Prix max  £">
                                        </div>
                                        <div class="bookcar-btn bookinput-item">
                                            <button type="submit">Trouver</button>
                                        </div>
                                    </form>
                                </div>
                </div>
                <!-- Page Title End -->
            </div>
        </div>
    </section>
    <!--== Page Title Area End ==-->
    <!--== Car List Area Start ==-->
    <section id="car-list-area" class="section-padding">
        <div class="container">
        @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
        @endif
            <div class="row">
                <!-- Car List Content Start -->
                <div class="col-lg-12">
                    <div class="car-list-content">
                        <div class="row">
                            @foreach($data  as $key => $car)
                            <!-- Single Car Start -->
                            <div class="col-lg-4 col-md-4">
                                <div class="single-car-wrap">
                                    <div class="car-list-thumb car-thumb-1" style="background-image: url({{$car->images[0]}});"></div>
                                    <div class="car-list-info without-bar">
                                        <h2><a href="#">{{$car->title}}</a></h2>
                                        <h5>{{$car->prix.' £'}}</h5>
                                        <p>{{$car->description}}</p>
                                        <ul class="car-info-list">
                                            <li>{{$car->kilometrage.' KM'}}</li>
                                            <li>{{$car->energie}}</li>
                                            <li>{{$car->boite}}</li>
                                        </ul>
                                        <a href="{{url('/car-details/'.$car->id.'/'.$car->title)}}" class="rent-btn">Détails</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Single Car End -->
                            @endforeach
                            
                        </div>
                    </div>
                </div>
                <!-- Car List Content End -->
            </div>
        </div>
    </section>
    <!--== Car List Area End ==-->
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
                        Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This webSite was made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://github.com/aminmed" target="_blank">Amin</a> based on template from <a href="https://colorlib.com" target="_blank">Colorlib</a>
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