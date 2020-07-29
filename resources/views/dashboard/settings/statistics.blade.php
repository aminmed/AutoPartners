@extends('dashboard.layouts.app')

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/css/extensions/sweetalert.css') }}?v={{ config('app.version') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/css/extensions/toastr.css') }}?v={{ config('app.version') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/plugins/extensions/toastr.css') }}?v={{ config('app.version') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/css/forms/toggle/switchery.min.css') }}?v={{ config('app.version') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/plugins/forms/switch.css') }}?v={{ config('app.version') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
 
@section('script')
    <script src="{{ asset('assets/vendors/js/extensions/sweetalert.min.js') }}?v={{ config('app.version') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/js/extensions/toastr.min.js') }}?v={{ config('app.version') }}"></script>
    <script src="{{ asset('assets/js/scripts.js') }}?v={{ config('app.version') }}"></script>
    <script src="{{ asset('assets/vendors/js/forms/toggle/bootstrap-checkbox.min.js') }}?v={{ config('app.version') }}"></script>
    <script src="{{ asset('assets/vendors/js/forms/toggle/switchery.min.js') }}?v={{ config('app.version') }}"></script>
    <script type="text/javascript">
        $('.switch:checkbox').checkboxpicker();
    </script>
@endsection

@section('content')
    <section>
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card bg-transparent">
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <form class="form" method="post" data-url="{{ $data['route'] }}">
                                @csrf
                                <div class="form-group" id="home">
                                    <label>Affichage de la section dans l'accueil</label>
                                    <div class="position-relative has-icon-left">
                                        <input type="checkbox" class="switch" data-off-label="Non" data-on-label="Oui" name="statistics[home]" {{ $data['statistics']['home'] == 'yes' ? 'checked' : '' }} />
                                    </div>
                                </div>
                                <div class="form-group" id="statistics_clients">
                                    <label>Nombre des clients </label>
                                    <div class="position-relative has-icon-left">
                                        <input type="text" class="form-control" id="statistics_clients" name="statistics[clients]" value="{{ $data['statistics']['clients'] }}">
                                        <div class="form-control-position">
                                            <i class="fa fa-address-book"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" id="statistics_stock">
                                    <label>Stock </label>
                                    <div class="position-relative has-icon-left">
                                        <input type="text" class="form-control" id="statistics_stock" name="statistics[stock]" value="{{ $data['statistics']['stock'] }}">
                                        <div class="form-control-position">
                                            <i class="fa fa-shopping-cart "></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" id="statistics_offices">
                                    <label>Bureaux </label>
                                    <div class="position-relative has-icon-left">
                                        <input type="text" class="form-control" id="statistics_offices" name="statistics[offices]" value="{{ $data['statistics']['offices'] }}">
                                        <div class="form-control-position">
                                            <i class="fa fa-building "></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="button" id="submit" class="btn btn-primary btn-block mt-4">
                                        <i class="ft-check-square"></i>
                                        {{ $data["button"] }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection