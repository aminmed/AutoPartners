@extends('dashboard.layouts.app')

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/core/colors/palette-gradient.css') }}?v={{ config('app.version') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/fonts/simple-line-icons/style.css') }}?v={{ config('app.version') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/core/colors/palette-gradient.css') }}?v={{ config('app.version') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/timeline.css') }}?v={{ config('app.version') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/css/charts/morris.css') }}?v={{ config('app.version') }}">
@endsection

@section('script')
	<script src="{{ asset('assets/js/scripts.js') }}?v={{ config('app.version') }}"></script>
    <script src="{{ asset('assets/vendors/js/charts/raphael-min.js') }}?v={{ config('app.version') }}"></script>
    <script src="{{ asset('assets/vendors/js/charts/morris.min.js') }}?v={{ config('app.version') }}"></script>
@endsection

@section('content')
<div class="row">
    <div class="col-xl-4 col-lg-6 col-12">
    	<a href="{{ route('dashboard.users.index') }}">
	        <div class="card">
	            <div class="card-content">
	                <div class="media align-items-stretch">
	                    <div class="p-2 text-center bg-blue-grey bg-darken-2">
	                        <i class="fa fa-users font-large-2 white"></i>
	                    </div>
	                    <div class="p-2 bg-gradient-x-blue-grey white media-body">
	                        <h5>Comptes</h5>
	                        <h5 class="text-bold-400 mb-0">{{ $counts['users'] }}</h5>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </a>
    </div>
    <div class="col-xl-4 col-lg-6 col-12">
    	<a href="{{ route('dashboard.testimonial.index') }}">
	        <div class="card">
	            <div class="card-content">
	                <div class="media align-items-stretch">
	                    <div class="p-2 text-center bg-pink bg-darken-2">
	                        <i class="fa fa-user font-large-2 white"></i>
	                    </div>
	                    <div class="p-2 bg-gradient-x-pink white media-body">
	                        <h5>Témoignages</h5>
	                        <h5 class="text-bold-400 mb-0">{{ $counts['testimonial'] }}</h5>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </a>
    </div>
    <div class="col-xl-4 col-lg-6 col-12">
    	<a href="{{ route('dashboard.messages.index') }}">
	        <div class="card">
	            <div class="card-content">
	                <div class="media align-items-stretch">
	                    <div class="p-2 text-center bg-warning bg-darken-2">
	                        <i class="fa fa-envelope font-large-2 white"></i>
	                    </div>
	                    <div class="p-2 bg-gradient-x-warning white media-body">
	                        <h5>Messages</h5>
	                        <h5 class="text-bold-400 mb-0">{{ $counts['messages'] }}</h5>
	                    </div>
	                </div>
	            </div>
	        </div>
    	</a>
    </div>
    <div class="col-xl-4 col-lg-6 col-12">
    	<a href="{{ route('dashboard.services.index') }}">
	        <div class="card">
	            <div class="card-content">
	                <div class="media align-items-stretch">
	                    <div class="p-2 text-center bg-teal bg-darken-2">
	                        <i class="fa fa-life-ring font-large-2 white"></i>
	                    </div>
	                    <div class="p-2 bg-gradient-x-teal white media-body">
	                        <h5>Services</h5>
	                        <h5 class="text-bold-400 mb-0">{{ $counts['services'] }}</h5>
	                    </div>
	                </div>
	            </div>
	        </div>
    	</a>
    </div>
    <div class="col-xl-4 col-lg-6 col-12">
    	<a href="{{ route('dashboard.categories.index') }}">
	        <div class="card">
	            <div class="card-content">
	                <div class="media align-items-stretch">
	                    <div class="p-2 text-center bg-danger bg-darken-2">
	                        <i class="fa fa-server font-large-2 white"></i>
	                    </div>
	                    <div class="p-2 bg-gradient-x-danger white media-body">
	                        <h5>Catégories</h5>
	                        <h5 class="text-bold-400 mb-0">{{ $counts['categories'] }}</h5>
	                    </div>
	                </div>
	            </div>
	        </div>
    	</a>
    </div>
    <div class="col-xl-4 col-lg-6 col-12">
    	<a href="{{ route('dashboard.articles.index') }}">
	        <div class="card">
	            <div class="card-content">
	                <div class="media align-items-stretch">
	                    <div class="p-2 text-center bg-success bg-darken-2">
	                        <i class="fa fa-car font-large-2 white"></i>
	                    </div>
	                    <div class="p-2 bg-gradient-x-success white media-body">
	                        <h5>Articles</h5>
	                        <h5 class="text-bold-400 mb-0">{{ $counts['articles'] }}</h5>
	                    </div>
	                </div>
	            </div>
	        </div>
    	</a>
    </div>
</div>
@endsection
