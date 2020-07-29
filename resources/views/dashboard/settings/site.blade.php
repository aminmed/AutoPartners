@extends('dashboard.layouts.app')

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/css/extensions/sweetalert.css') }}?v={{ config('app.version') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/css/extensions/toastr.css') }}?v={{ config('app.version') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/plugins/extensions/toastr.css') }}?v={{ config('app.version') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/css/ui/prism.min.css') }}?v={{ config('app.version') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/css/forms/tags/tagging.css') }}?v={{ config('app.version') }}">
@endsection
 
@section('script')
    <script src="{{ asset('assets/vendors/js/extensions/sweetalert.min.js') }}?v={{ config('app.version') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/js/extensions/toastr.min.js') }}?v={{ config('app.version') }}"></script>
    <script src="{{ asset('assets/js/scripts.js') }}?v={{ config('app.version') }}"></script>
    <script src="{{ asset('assets/vendors/js/forms/tags/tagging.min.js') }}?v={{ config('app.version') }}"></script>
    <script src="{{ asset('assets/vendors/js/ui/prism.min.js') }}?v={{ config('app.version') }}"></script>
    <script type="text/javascript">
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
                                <div class="form-group" id="title">
                                    <label>Titre du site</label>
                                    <div class="position-relative has-icon-left">
                                        <input type="text" class="form-control" id="title" name="title" autofocus="" value="{{ $data['title'] }}">
                                        <div class="form-control-position">
                                            <i class="fa fa-paragraph"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" id="keywords">
                                    <label>Mots clefs</label>
                                    <div dir="rtl" class="position-relative has-icon-left">
                                        <div class="keywords form-control tagsinput" id="keywords" data-tags-input-name="keywords">{{ $data['keywords'] }}</div>
                                        <div class="form-control-position">
                                            <i class="fa fa-key"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" id="description">
                                    <label> Description </label>
                                    <div class="position-relative has-icon-left">
                                        <textarea id="description" name="description" class="form-control" rows="5">{{ $data['description'] }}</textarea>
                                        <div class="form-control-position">
                                            <i class="fa fa-file-o"></i>
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