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
                                <div class="form-group" id="about_us_image">
                                    <label>Image</label>
                                    <div class="fileupload">
                                        <div class="thumbnail">
                                            <img class="img-thumbnail bg-white rounded" src="{{ $data['about_us']['image'] == "" ? asset('images/no-image.png') : asset($data['about_us']['image']) }}" />
                                        </div>
                                        <span class="btn btn-file btn-primary">
                                            <i class="ft-upload"></i>
                                            changer image
                                            <input type="file" id="imageinput" data-id="about_us_image" data-url="{{ route('dashboard.upload') }}" data-text="changer image " data-width="1920" data-height="1080" data-folder="image" />
                                        </span>
                                        <div class="position-relative has-icon-left">
                                            <input type="text" class="form-control" id="about_us_image" name="about_us[image]" value="{{ $data['about_us']['image'] }}" readonly="">
                                            <div class="form-control-position">
                                                <i class="fa fa-image"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" id="about_us_title">
                                    <label>Titre de la section</label>
                                    <div class="position-relative has-icon-left">
                                        <input type="text" class="form-control" id="about_us_title" name="about_us[title]" value="{{ $data['about_us']['title'] }}">
                                        <div class="form-control-position">
                                            <i class="fa fa-paragraph"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" id="about_us_sub_title">
                                    <label>Sous-Titre de la section</label>
                                    <div class="position-relative has-icon-left">
                                        <input type="text" class="form-control" id="about_us_sub_title" name="about_us[sub_title]" value="{{ $data['about_us']['sub_title'] }}">
                                        <div class="form-control-position">
                                            <i class="fa fa-paragraph"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" id="about_us_description">
                                    <label>  Description </label>
                                    <div class="position-relative has-icon-left">
                                    <textarea id="about_us_description" name="about_us[description]" class="form-control" rows="5">{{ $data['about_us']['description'] }}</textarea>
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