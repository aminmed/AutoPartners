@extends('dashboard.layouts.app')

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/css/extensions/sweetalert.css') }}?v={{ config('app.version') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/css/extensions/toastr.css') }}?v={{ config('app.version') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/plugins/extensions/toastr.css') }}?v={{ config('app.version') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/css/forms/toggle/switchery.min.css') }}?v={{ config('app.version') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/plugins/forms/switch.css') }}?v={{ config('app.version') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/css/ui/prism.min.css') }}?v={{ config('app.version') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/css/forms/tags/tagging.css') }}?v={{ config('app.version') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
 
@section('script')
    <script src="{{ asset('assets/vendors/js/extensions/sweetalert.min.js') }}?v={{ config('app.version') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/js/extensions/toastr.min.js') }}?v={{ config('app.version') }}"></script>
    <script src="{{ asset('assets/js/scripts.js') }}?v={{ config('app.version') }}"></script>
    <script src="{{ asset('assets/vendors/js/forms/toggle/bootstrap-checkbox.min.js') }}?v={{ config('app.version') }}"></script>
    <script src="{{ asset('assets/vendors/js/forms/toggle/switchery.min.js') }}?v={{ config('app.version') }}"></script>
    <script src="{{ asset('assets/vendors/js/forms/tags/tagging.min.js') }}?v={{ config('app.version') }}"></script>
    <script src="{{ asset('assets/vendors/js/ui/prism.min.js') }}?v={{ config('app.version') }}"></script>
    <script type="text/javascript">
        $('.switch:checkbox').checkboxpicker();
        $(".keywords").tagging({
            "keywords": true,
            "forbidden-chars": ["," , ".", "_", "?"]
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
                                <div class="form-group" id="name">
                                    <label>Nom du Fabricant</label>
                                    <div class="position-relative has-icon-left">
                                        <input type="text" class="form-control" id="name" name="name" value="{{ $data['name'] }}">
                                        <div class="form-control-position">
                                            <i class="fa fa-paragraph"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" id="description">
                                    <label>Description</label>
                                    <div class="position-relative has-icon-left">
                                        <textarea class="form-control" id="description" name="description" rows="5">{{ $data['description'] }}</textarea>
                                        <div class="form-control-position">
                                            <i class="fa fa-list"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" id="about_us_image">
                                    <label>Image</label>
                                    <div class="fileupload">
                                        <div class="thumbnail">
                                            <img class="img-thumbnail bg-white rounded" src="{{ $data['logo'] == "" ? asset('images/no-image.png') : asset($data['logo']) }}" />
                                        </div>
                                        <span class="btn btn-file btn-primary">
                                            <i class="ft-upload"></i>
                                            changer image
                                            <input type="file" id="imageinput" data-id="about_us_image" data-url="{{ route('dashboard.upload') }}" data-text="changer image " data-width="1920" data-height="1080" data-folder="categories" />
                                        </span>
                                        <div class="position-relative has-icon-left">
                                            <input type="text" class="form-control" id="about_us_image" name="logo" value="{{ $data['logo'] }}" readonly="">
                                            <div class="form-control-position">
                                                <i class="fa fa-image"></i>
                                            </div>
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