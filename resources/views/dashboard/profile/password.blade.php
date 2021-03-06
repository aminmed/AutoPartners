@extends('dashboard.layouts.app')

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/css/extensions/sweetalert.css') }}?v={{ config('app.version') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/css/extensions/toastr.css') }}?v={{ config('app.version') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/plugins/extensions/toastr.css') }}?v={{ config('app.version') }}">
@endsection
 
@section('script')
    <script src="{{ asset('assets/vendors/js/extensions/sweetalert.min.js') }}?v={{ config('app.version') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/js/extensions/toastr.min.js') }}?v={{ config('app.version') }}"></script>
    <script src="{{ asset('assets/js/scripts.js') }}?v={{ config('app.version') }}"></script>
    <script type="text/javascript">
        $('#showhide').click(function (){
            var type = $('input[name=password]').attr('type');
            var text = $(this).html();
            if (type == 'password' && text == 'afficher') {
               $(this).html('cacher'); 
               $('input[name=password]').attr('type', 'text');
               $('input[name=password_confirmation]').attr('type', 'text');
            }else {
               $(this).html('afficher'); 
               $('input[name=password]').attr('type', 'password');
               $('input[name=password_confirmation]').attr('type', 'password');
            }
        });
        $('#generate').click(function (){
            var password = generate(15);
            $('input[name=password]').val(password);
            $('input[name=password_confirmation]').val(password);
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
                                <div class="form-group" id="password_old">
                                    <label>  mot de passe actuel</label>
                                    <div class="position-relative has-icon-left">
                                        <input type="password" class="form-control" name="password_old" autofocus="">
                                        <div class="form-control-position">
                                            <i class="fa fa-lock"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" id="password">
                                    <label> nouveau mot de passe</label>
                                    <div class="float-right">
                                        <button type="button" class="btn btn-primary btn-sm" id="showhide">afficher</button>
                                        <button type="button" class="btn btn-primary btn-sm" id="generate"> générer aléatoirement</button>
                                    </div>
                                    <div class="position-relative has-icon-left">
                                        <input type="password" class="form-control" name="password" autofocus="">
                                        <div class="form-control-position">
                                            <i class="fa fa-key"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" id="password_confirmation">
                                    <label>  confirmer mot de passe</label>
                                    <div class="position-relative has-icon-left">
                                        <input type="password" class="form-control" name="password_confirmation" autofocus="">
                                        <div class="form-control-position">
                                            <i class="fa fa-key"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="button" id="submit" class="btn btn-primary btn-block mt-1">
                                        <i class="ft-check-square"></i>
                                        Mettre à jour
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