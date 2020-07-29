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
        $(".options").tagging({
            "keywords": true,
            "forbidden-chars": ["," , ".", "_", "?"]
        });
        $(document).on('click', '#delete_image', function(){
            $(this).closest('div#showimage').fadeOut(500, function() {
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
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label> Catégorie</label>
                                            <select class="form-control" name="category" id="category">
                                            @foreach ($categories as $key => $value)
                                                <option value="{{ $value->id }}" >{{ $value->name }}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label> Fabricant</label>
                                            <select class="form-control" name="fabricant" id="fabricant">
                                            @foreach ($fabricants as $key => $value)
                                            <option value="{{ $value->id }}" >{{ $value->name }}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" id="title">
                                    <label>Nom de l'article</label>
                                    <div class="position-relative has-icon-left">
                                        <input type="text" class="form-control" id="title" name="title" value="{{ $data['title'] }}">
                                        <div class="form-control-position">
                                            <i class="fa fa-paragraph"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group" id="version">
                                            <label>Version</label>
                                            <div class="position-relative has-icon-left">
                                                <input type="text" class="form-control" id="version" name="version" value="{{ $data['version'] }}">
                                                <div class="form-control-position">
                                                    <i class="fa fa-paragraph"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group" id="puissance">
                                            <label>Puissance</label>
                                            <div class="position-relative has-icon-left">
                                                <input type="text" class="form-control" id="puissance" name="puissance" value="{{ $data['puissance'] }}">
                                                <div class="form-control-position">
                                                    <i class="fa fa-paragraph"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label> energie</label>
                                            <select class="form-control" name="energie" id="energie">
                                                <option value="Diesel" >Diesel</option>
                                                <option value="Essence" >Essence</option>
                                                <option value="Essence et GPL" >Essence et GPL</option>
                                                <option value="GPL" >GPL</option>
                                                <option value="Eléctrique" >Eléctrique</option>
                                                <option value="Hybride : Essence et électrique" >Hybride : Essence et électrique</option>
                                                <option value="Hybride : Diesel et électrique" >Hybride : Diesel et électrique</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group" id="kilometrage">
                                            <label>kilométrage</label>
                                            <div class="position-relative has-icon-left">
                                                <input type="text" class="form-control" id="kilometrage" name="kilometrage" value="{{ $data['kilometrage'] }}">
                                                <div class="form-control-position">
                                                    <i class="fa fa-paragraph"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group" id="millesime">
                                            <label>millesime</label>
                                            <div class="position-relative has-icon-left">
                                                <input type="text" class="form-control" id="millesime" name="millesime" value="{{ $data['millesime'] }}">
                                                <div class="form-control-position">
                                                    <i class="fa fa-paragraph"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group" id="dateCirculation">
                                            <label>Date de circulation</label>
                                            <div class="position-relative has-icon-left">
                                                <input type="text" class="form-control" placeholder="yyyy-mm-dd" id="dateCirculation" name="dateCirculation" value="{{ $data['dateCirculation'] }}">
                                                <div class="form-control-position">
                                                    <i class="fa fa-paragraph"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group" id="nbPortes">
                                            <label>nombre de portes</label>
                                            <div class="position-relative has-icon-left">
                                                <input type="text" class="form-control" id="nbPortes" name="nbPortes" value="{{ $data['nbPortes'] }}">
                                                <div class="form-control-position">
                                                    <i class="fa fa-paragraph"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group" id="couleur">
                                            <label>Couleur exterieur</label>
                                            <div class="position-relative has-icon-left">
                                                <input type="text" class="form-control" id="couleur" name="couleur" value="{{ $data['couleur'] }}">
                                                <div class="form-control-position">
                                                    <i class="fa fa-paragraph"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group" id="prix">
                                            <label>Prix</label>
                                            <div class="position-relative has-icon-left">
                                                <input type="text" class="form-control" id="prix" name="prix" value="{{ $data['prix'] }}">
                                                <div class="form-control-position">
                                                    <i class="fa fa-paragraph"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group" id="promotion">
                                            <label>Promotion</label>
                                            <div class="position-relative has-icon-left">
                                                <input type="text" class="form-control" id="promotion" name="promotion" value="{{ $data['promotion'] }}">
                                                <div class="form-control-position">
                                                    <i class="fa fa-paragraph"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" id="options">
                                    <label>Options</label>
                                    <div dir="rtl" class="position-relative has-icon-left">
                                        <div class="keywords form-control tagsinput" id="options" data-tags-input-name="options">{{ $data['options'] }}</div>
                                        <div class="form-control-position">
                                            <i class="fa fa-key"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>La boite</label>
                                            <select class="form-control" name="boite" id="boite">
                                                <option value="Manuelle" >Manuelle</option>
                                                <option value="Automatique" >Automatique</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Première Main</label>
                                            <select class="form-control" name="premiereMain" id="premiereMain">
                                                <option value="yes" >Oui</option>
                                                <option value="no" >No</option>
                                            </select>
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
                                <div class="form-group" id="image">
                                    <label>Photos</label>
                                    <div class="fileupload">
                                        <span class="btn btn-file btn-success btn-block">
                                            <i class="ft-upload"></i>
                                             Ajouter photo
                                            <input type="file" id="imageinput" data-id="image" data-url="{{ route('dashboard.upload') }}" data-text= "ajouter photo" data-folder="articles" data-work="true" />
                                        </span>
                                        <div class="row pt-1" id="images">
                                            @if (!empty($data['images']))
                                            @foreach ($data['images'] as $image)
                                            <div class="col-xl-3 col-lg-4 col-6" id="showimage">
                                                <div class="thumbnail">
                                                    <img class="img-thumbnail bg-white rounded" src="{{ $image }}" />
                                                </div>
                                                <input type="hidden" name="images[]" value="{{ $image }}">
                                                <button type="button" class="btn btn-danger btn-block" id="delete_image">
                                                    <i class="fa fa-times"></i>  supprimer image
                                                </button>
                                            </div>
                                            @endforeach
                                            @endif
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