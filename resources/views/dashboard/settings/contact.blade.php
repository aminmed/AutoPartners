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
        $(document).on('click', '#networkadd', function(){
            $('#alert').fadeOut(500);
            var name = $('input[name=name]').val();
            var link = $('input[name=link]').val();
            if (name == "" || link == "") {
                $('#alert').fadeIn(500);
            }else {
                $('input[name=name]').val('');
                $('input[name=link]').val('');
                $('#lists').append('<div id="key-'+name+'" class="input-group">'+
                                        '<input type="text" class="form-control" value="'+name+'" readonly="">'+
                                        '<input type="text" name="contact[networks]['+name+']" class="form-control" value="'+link+'" placeholder="Link">'+
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
                                <div class="form-group" id="contact_title">
                                    <label> Titre de la section</label>
                                    <div class="position-relative has-icon-left">
                                        <input type="text" class="form-control" id="contact_title" name="contact[title]" value="{{ $data['contact']['title'] }}">
                                        <div class="form-control-position">
                                            <i class="fa fa-paragraph"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" id="contact_address">
                                    <label> Adresse</label>
                                    <div class="position-relative has-icon-left">
                                        <input type="text" class="form-control" id="contact_address" name="contact[address]" value="{{ $data['contact']['address'] }}">
                                        <div class="form-control-position">
                                            <i class="fa fa-map"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" id="company_name">
                                    <label> Nom de l'entreprise</label>
                                    <div class="position-relative has-icon-left">
                                        <input type="text" class="form-control" id="company_name" name="contact[company_name]" value="{{ $data['contact']['company_name'] }}">
                                        <div class="form-control-position">
                                            <i class="fa fa-map"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" id="company_domain">
                                    <label> Domaine d'exercise</label>
                                    <div class="position-relative has-icon-left">
                                        <input type="text" class="form-control" id="company_domain" name="contact[company_domain]" value="{{ $data['contact']['company_domain'] }}">
                                        <div class="form-control-position">
                                            <i class="fa fa-map"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" id="contact_map_lat">
                                    <label>Map latitude</label>
                                    <div class="position-relative has-icon-left">
                                        <input type="text" class="form-control" id="contact_map_lat" name="contact[map_lat]" value="{{ $data['contact']['map_lat'] }}">
                                        <div class="form-control-position">
                                            <i class="fa fa-map"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" id="contact_map_lng">
                                    <label>  Map longitude</label>
                                    <div class="position-relative has-icon-left">
                                        <input type="text" class="form-control" id="contact_map_lng" name="contact[map_lng]" value="{{ $data['contact']['map_lng'] }}">
                                        <div class="form-control-position">
                                            <i class="fa fa-map"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" id="contact_email">
                                    <label> Email</label>
                                    <div class="position-relative has-icon-left">
                                        <input type="text" class="form-control" id="contact_email" name="contact[email]" value="{{ $data['contact']['email'] }}">
                                        <div class="form-control-position">
                                            <i class="fa fa-envelope"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" id="contact_phone">
                                    <label> Téléphone</label>
                                    <div class="position-relative has-icon-left">
                                        <input type="text" class="form-control" id="contact_phone" name="contact[phone]" value="{{ $data['contact']['phone'] }}">
                                        <div class="form-control-position">
                                            <i class="fa fa-phone"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" id="openning">
                                    <label>Heures de travail </label>
                                    <div class="position-relative has-icon-left">
                                        <input type="text" class="form-control" id="openning" name="contact[openning]" value="{{ $data['contact']['openning'] }}">
                                        <div class="form-control-position">
                                            <i class="fa fa-briefcase"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label> Les comptes social média </label>
                                    <div class="input-group">
                                        <input type="text" name="name" class="form-control" placeholder="exemple: facebook">
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
                                    @if (!empty($data['contact']['networks']))
                                        @foreach ($data['contact']['networks'] as $key => $value)
                                        <div id="key-{{ $key }}" class="input-group">
                                            <input type="text" class="form-control" value="{{ $key }}" readonly="">
                                            <input type="text" name="contact[networks][{{ $key }}]" class="form-control" value="{{ $value }}" placeholder="Link">
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