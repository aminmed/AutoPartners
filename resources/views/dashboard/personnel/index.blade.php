@extends('dashboard.layouts.app')

@section('style')
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/css/extensions/sweetalert.css') }}?v={{ config('app.version') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/css/extensions/toastr.css') }}?v={{ config('app.version') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/plugins/extensions/toastr.css') }}?v={{ config('app.version') }}">
	<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('script')
    <script src="{{ asset('assets/vendors/js/extensions/sweetalert.min.js') }}?v={{ config('app.version') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/js/extensions/toastr.min.js') }}?v={{ config('app.version') }}"></script>
    <script src="{{ asset('assets/js/scripts.js') }}?v={{ config('app.version') }}"></script>
    <script type="text/javascript">
        $("#keyboard").keydown(function(event) {
            if(event.which == 13) {
                $('#urlSearch').trigger('click');
                return false;
            }
        });
    </script>
@endsection

@section('content')
	<section>
		<div class="row">
		    <div class="col-12">
                <div class="card">
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <div id="pageContents">
                                @include($data['sub'].'.data')
                            </div>
                        </div>
                    </div>
                </div>
		    </div>
		</div>
	</section>
@endsection
