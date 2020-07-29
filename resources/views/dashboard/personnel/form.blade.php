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
        $(document).on('click', '#networkadd', function(){
            $('#alert').fadeOut(500);
            var name = $('input[name=compte]').val();
            var link = $('input[name=link]').val();
            if (name == "" || link == "") {
                $('#alert').fadeIn(500);
            }else {
                $('input[name=name]').val('');
                $('input[name=link]').val('');
                $('#lists').append('<div id="key-'+name+'" class="input-group">'+
                                        '<input type="text" class="form-control" value="'+name+'" readonly="">'+
                                        '<input type="text" name="contact['+name+']" class="form-control" value="'+link+'" placeholder="Link">'+
                                        '<div class="input-group-append">'+
                                            '<button type="button" id="networkdelete" data-name="'+name+'" class="btn btn-red">'+
                                                '<i class="fa fa-trash"></i> '+ 'delete'+
                                            '</button>'+
                                        '</div>'+
                                    '</div>');
            }
        });
        $(document).on('click', '#networkdelete', function(){
            var name = $(this).data('name');
            $('#key-'+name).fadeOut(500, function() {
                $(this).remove();
            });
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
                                <div class="form-group" id="name">
                                    <label>Nom du membre</label>
                                    <div class="position-relative has-icon-left">
                                        <input type="text" class="form-control" id="name" name="name" value="{{ $data['name'] }}">
                                        <div class="form-control-position">
                                            <i class="fa fa-paragraph"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" id="role">
                                    <label> Role</label>
                                    <div class="position-relative has-icon-left">
                                        <input type="text" class="form-control" id="role" name="role" value="{{ $data['role'] }}">
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
                                            <img class="img-thumbnail bg-white rounded" src="{{ $data['photo'] == "" ? asset('images/no-image.png') : asset($data['photo']) }}" />
                                        </div>
                                        <span class="btn btn-file btn-primary">
                                            <i class="ft-upload"></i>
                                            changer image
                                            <input type="file" id="imageinput" data-id="about_us_image" data-url="{{ route('dashboard.upload') }}" data-text="changer image " data-folder="personnel" />
                                        </span>
                                        <div class="position-relative has-icon-left">
                                            <input type="text" class="form-control" id="about_us_image" name="photo" value="{{ $data['photo'] }}" readonly="">
                                            <div class="form-control-position">
                                                <i class="fa fa-image"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label> Les comptes social média </label>
                                    <div class="input-group">
                                        <input type="text" name="compte" class="form-control" placeholder="exemple: facebook">
                                        <input type="text" name="link" class="form-control" placeholder="link">
                                        <div class="input-group-append">
                                            <button type="button" id="networkadd" class="btn btn-red">
                                                <i class="fa fa-plus"></i>
                                                Ajouter
                                            </button>
                                        </div>
                                    </div>
                                    <div id="alert" class="alert alert-danger mb-2" style="display: none;">
                                        s'il vous plait, remplir tous les champs ! 
                                    </div>
                                </div>
                                <hr>
                                <div id="lists">
                                    @if (!empty($data['contact']))
                                        @foreach ($data['contact'] as $key => $value)
                                        <div id="key-{{ $key }}" class="input-group">
                                            <input type="text" class="form-control" value="{{ $key }}" readonly="">
                                            <input type="text" name="contact['{{ $key }}']" class="form-control" value="{{ $value }}" placeholder="Link">
                                            <div class="input-group-append">
                                                <button type="button" id="networkdelete" data-name="{{ $key }}" class="btn btn-red">
                                                    <i class="fa fa-trash"></i> delete
                                                </button>
                                            </div>
                                        </div>
                                        @endforeach
                                    @endif
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