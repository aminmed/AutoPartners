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
                                        <input type="checkbox" class="switch" data-off-label="Non" data-on-label="Oui" name="personnel[home]" {{ $data['personnel']['home'] == 'yes' ? 'checked' : '' }} />
                                    </div>
                                </div>
                                <div class="form-group" id="personnel_title">
                                    <label>Titre de la section </label>
                                    <div class="position-relative has-icon-left">
                                        <input type="text" class="form-control" id="personnel_title" name="personnel[title]" value="{{ $data['personnel']['title'] }}">
                                        <div class="form-control-position">
                                            <i class="fa fa-paragraph"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" id="personnel_description">
                                    <label> Description </label>
                                    <div class="position-relative has-icon-left">
                                        <textarea id="personnel_description" name="personnel[sub_title]" class="form-control" rows="5">{{ $data['personnel']['sub_title'] }}</textarea>
                                        <div class="form-control-position">
                                            <i class="fa fa-file-o"></i>
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