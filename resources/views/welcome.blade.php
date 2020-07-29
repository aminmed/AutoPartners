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
    <style>
        @for($i = 0; $i < count($sliders); $i++) 
            {{'.slider-bg-'.($i+1)}}{
                background-image: url("{{$sliders[$i]->image}}");
            }
        @endfor
    </style>
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
                                <li class="active"><a href="#">Accueil</a>
                                </li>
                                <li><a href="#about-area">Qui somme nous?</a></li>
                                <li><a href="{{url('/cars')}}">Nos vehicules</a></li>
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

    <!--== Slider Area Start ==-->
    <section id="home-slider-area">
        @foreach($sliders as $key => $slider)
        <div class="{{'home-slider-item slider-bg-'.($key+1).' overlay'}}">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="slideshowcontent">
                            <h1>{{$slider->title}}</h1>
                            <p>{!! $slider->text !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </section>
    
    <!--== Slider Area End ==-->
 
    <!--== About Us Area Start ==-->
    <section id="about-area" class="section-padding">
        <div class="container">
            <div class="row">
                <!-- Section Title Start -->
                <div class="col-lg-12">
                    <div class="section-title  text-center">
                        <h2>{{$settings['about_us']['title']}}</h2>
                        <span class="title-line"><i class="fa fa-car"></i></span>
                        <p>{{$settings['about_us']['sub_title']}}</p>
                    </div>
                </div>
                <!-- Section Title End -->
            </div>

            <div class="row">
                <!-- About Content Start -->
                <div class="col-lg-6">
                    <div class="display-table">
                        <div class="display-table-cell">
                            <div class="about-content">
                                <p>{!!$settings['about_us']['description']!!}</p>
                                <div class="about-btn">
                                    <a href="{{url('/gallery')}}">Galerie</a>
                                    <a href="{{url('/contact')}}">Contact</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- About Content End -->

                <!-- About Video Start -->
                <div class="col-lg-6">
                    <div class="about-image">
                        <img src="{{$settings['about_us']['image']}}" alt="JSOFT">
                    </div>
                </div>
                <!-- About Video End -->
            </div>
        </div>
    </section>
    <!--== About Us Area End ==-->

    <!--== Partner Area Start ==-->
    <div id="partner-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="partner-content-wrap">
                        @foreach($partners as $partner)
                        <!-- Single Partner Start -->
                        <div class="single-partner">
                            <div class="display-table">
                                <div class="display-table-cell">
                                    <img src="{{$partner->logo}}" alt="{{$partner->name}}">
                                </div>
                            </div>
                        </div>
                        <!-- Single Partner End -->
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--== Partner Area End ==-->
    @if($settings['services']['home'] == 'on') 
    <!--== Services Area Start ==-->
    <section id="service-area" class="section-padding">
        <div class="container">
            <div class="row">
                <!-- Section Title Start -->
                <div class="col-lg-12">
                    <div class="section-title  text-center">
                        <h2>{{$settings['services']['title']}}</h2>
                        <span class="title-line"><i class="fa fa-car"></i></span>
                        <p>{{$settings['services']['sub_title']}}</p>
                    </div>
                </div>
                <!-- Section Title End -->
            </div>

           
			<!-- Service Content Start -->
			<div class="row">
                @foreach($services as $service)
				<!-- Single Service Start -->
				<div class="col-lg-4 text-center">
					<div class="service-item">
						<i class="{{$service->icon}}"></i>
						<h3>{{$service->title}}</h3>
						<p>{!! $service->text !!}</p>
					</div>
				</div>
                <!-- Single Service End -->
                @endforeach
			</div>
			<!-- Service Content End -->
        </div>
    </section>
    <!--== Services Area End ==-->
    @endif
    <!--== Fun Fact Area Start ==-->
    <section id="funfact-area" class="overlay section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-11 col-md-12 m-auto">
                    <div class="funfact-content-wrap">
                        <div class="row">
                            <!-- Single FunFact Start -->
                            <div class="col-lg-4 col-md-6">
                                <div class="single-funfact">
                                    <div class="funfact-icon">
                                        <i class="fa fa-smile-o"></i>
                                    </div>
                                    <div class="funfact-content">
                                        <p><span class="counter">{{$settings['statistics']['clients']}}</span>+</p>
                                        <h4>Clients</h4>
                                    </div>
                                </div>
                            </div>
                            <!-- Single FunFact End -->

                            <!-- Single FunFact Start -->
                            <div class="col-lg-4 col-md-6">
                                <div class="single-funfact">
                                    <div class="funfact-icon">
                                        <i class="fa fa-car"></i>
                                    </div>
                                    <div class="funfact-content">
                                        <p><span class="counter">{{$settings['statistics']['stock']}}</span>+</p>
                                        <h4>Véhicules</h4>
                                    </div>
                                </div>
                            </div>
                            <!-- Single FunFact End -->

                            <!-- Single FunFact Start -->
                            <div class="col-lg-4 col-md-6">
                                <div class="single-funfact">
                                    <div class="funfact-icon">
                                        <i class="fa fa-bank"></i>
                                    </div>
                                    <div class="funfact-content">
                                        <p><span class="counter">{{$settings['statistics']['offices']}}</span>+</p>
                                        <h4>bureaux</h4>
                                    </div>
                                </div>
                            </div>
                            <!-- Single FunFact End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--== Fun Fact Area End ==-->
            
    <!--== Team Area Start ==-->
    <section id="team-area" class="section-padding">
        <div class="container">
            <div class="row">
                <!-- Section Title Start -->
                <div class="col-lg-12">
                    <div class="section-title  text-center">
                        <h2>{{$settings['personnel']['title']}}</h2>
                        <span class="title-line"><i class="fa fa-car"></i></span>
                        <p>{{$settings['personnel']['sub_title']}}</p>
                    </div>
                </div>
                <!-- Section Title End -->
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="team-content">
                        <div class="row">
                            <!-- Team Tab Menu start -->
                            <div class="col-lg-4">
                                <div class="team-tab-menu">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        @foreach($personnes as $key => $personne)
                                        <li class="nav-item">
                                            @if($key == 0)
                                            <a class="nav-link active" id="{{'tab_item_'.($key+1)}}" data-toggle="tab" href="{{'#team_member_'.($key+1)}}" role="tab" aria-selected="true">
                                            @else
                                            <a class="nav-link" id="{{'tab_item_'.($key+1)}}" data-toggle="tab" href="{{'#team_member_'.($key+1)}}" role="tab" aria-selected="true">
                                            @endif
                                                <div class="team-mem-icon">
                                                    <img src="{{$personne->photo}}" alt="JSOFT">
                                                </div>
                                                <h5>{{$personne->name}}</h5>
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <!-- Team Tab Menu End -->

                            <!-- Team Tab Content start -->
                            <div class="col-lg-8">
                                <div class="tab-content" id="myTabContent">
                                    @foreach($personnes as $key => $personne)
                                    <!-- Single Team  start -->
                                    @if($key == 0)
                                    <div class="tab-pane fade show active" id="{{'team_member_'.($key+1)}}" role="tabpanel" aria-labelledby="{{'tab_item_'.($key+1)}}">
                                    @else 
                                    <div class="tab-pane fade show " id="{{'team_member_'.($key+1)}}" role="tabpanel" aria-labelledby="{{'tab_item_'.($key+1)}}">
                                    @endif
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6">
                                                <div class="team-member-pro-pic">
                                                    <img src="{{$personne->photo}}" alt="JSOFT">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="team-member-info text-center">
                                                    <h4>{{$personne->name}}</h4>
                                                    <h5>{{$personne->role}}</h5>
                                                    <span class="quote-icon"><i class="fa fa-quote-left"></i></span>
                                                    <p>{!! $personne->description !!}</p>
                                                    <div class="team-social-icon">
                                                        @foreach(  json_decode($personne->contact,true) as $key => $network)
                                                            <a href="{{$network}}"><i class="{{'fa fa-'.$key}}"></i></a>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Single Team  End -->
                                    @endforeach
                                </div>
                            </div>
                            <!-- Team Tab Content End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--== Team Area End ==-->


    <!--== Testimonials Area Start ==-->
    <section id="testimonial-area" class="section-padding">
        <div class="container">
            <div class="row">
                <!-- Section Title Start -->
                <div class="col-lg-12">
                    <div class="section-title  text-center">
                        <h2>{{$settings['testimonial']['title']}}</h2>
                        <span class="title-line"><i class="fa fa-car"></i></span>
                        <p>{{$settings['testimonial']['sub_title']}}</p>
                    </div>
                </div>
                <!-- Section Title End -->
            </div>

            <div class="row">
                <div class="col-lg-8 col-md-12 m-auto">
                    <div class="testimonial-content">
                        @foreach($testimonials as $testimonial)
                        <!--== Single Testimoial Start ==-->
                        <div class="single-testimonial">
                            <p>{{$testimonial->text}}</p>
                            <h3>{{$testimonial->client_name}}</h3>
                            <div class="client-logo">
                                <img src="{{$testimonial->client_photo}}" alt="photo">
                            </div>
                        </div>
                        <!--== Single Testimoial End ==-->
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--== Testimonials Area End ==-->


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