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
        $('#typeswitch').change(function() {
            if($(this).is(":checked")) {
                $('#image').addClass("d-none");
                $('#video').removeClass("d-none");
            }else {
                $('#video').addClass("d-none");
                $('#image').removeClass("d-none");
            }
        });
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
                                    <label>Afficher dans la page d'accueil</label>
                                    <div class="position-relative has-icon-left">
                                        <input type="checkbox" class="switch" data-off-label="Non" data-on-label="Oui" name="home" {{ $data['home'] == 'yes' ? 'checked' : '' }} />
                                    </div>
                                </div>
                                <div class="form-group" id="image">
                                    <label>image (1920*700)</label>
                                    <div class="fileupload">
                                        <div class="thumbnail">
                                            <img class="img-thumbnail bg-white rounded" src="{{ $data['image'] == "" ? asset('images/no-image.png') : asset($data['image']) }}" />
                                        </div>
                                        <span class="btn btn-file btn-primary">
                                            <i class="ft-upload"></i>
                                            change image
                                            <input type="file" id="imageinput" data-id="image" data-url="{{ route('dashboard.upload') }}" data-text="change image"  data-folder="sliders" />
                                        </span>
                                        <div class="position-relative has-icon-left">
                                            <input type="text" class="form-control" id="image" name="image" value="{{ $data['image'] }}" readonly="">
                                            <div class="form-control-position">
                                                <i class="fa fa-image"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" id="title">
                                    <label>Titre</label>
                                    <div class="position-relative has-icon-left">
                                        <input type="text" class="form-control" name="title" autofocus="" value="{{ $data['title'] }}">
                                        <div class="form-control-position">
                                            <i class="fa fa-paragraph"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" id="text">
                                    <label>texte</label>
                                    <div class="position-relative has-icon-left">
                                        <textarea class="form-control" id="text" name="text" rows="5">{{ $data['text'] }}</textarea>
                                        <div class="form-control-position">
                                            <i class="fa fa-list"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="button" id="submit" class="btn btn-primary btn-block mt-1">
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