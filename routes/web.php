<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Validator as Validator;
use App\Slider; use App\Service; use App\Partner; use App\Testimonial; 
use App\Personne; use App\Fabricant; use App\Category; use App\Article; 
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    $sliders  = Slider::All();
    $services = Service::All(); 
    $partners = Partner::All(); 
    $testimonials = Testimonial::All();
    $personnes = Personne::All();
    return view('welcome',compact(
        'sliders', 'services', 'partners', 'testimonials', 'personnes'
    ));
});
Route::get('/contact', function () {
    return view ('contact'); 
});
Route::get('/cars', function () {
    $articles = Article::All(); 
    $data = array(); 
    foreach ($articles as $article) {
        $article->images = json_decode($article->images,true); 
        $data [] = $article; 
    }
    return view ('cars',['marques' => Fabricant::All(),'categories' => Category::All(),'data' =>$data]); 
});
Route::post('/cars', function (Request $request) {
    $rules = [
        'prix'            => 'required',
        'category'        => 'required',
        'fabricant'       => 'required',
        'energie'         => 'required'
    ];
    
    $validate = Validator::make($request->all(), $rules);

    if ($validate->fails()) {
        return back()->with('error','Erreurs, réessayez s\'il vous plait!'); 
    }
    $category = $request->input('category'); 
    $fabricant= $request->input('fabricant'); 
    $prix     = $request->input('prix'); 
    $energie  = $request->input('energie');
    $articles = Article::orderBy('prix')->get(); 
    $data = array(); 
    foreach($articles as $key => $article) {
        if (($category == "0")||($article->category_id == $category)) {
            if (($fabricant == "0")||($article->fabricant_id == $fabricant)) {
                if (($energie =="0")||($article->energie == $energie)) {
                    if (($prix == "Prix max  £")||($article->prix <= $prix)) {
                        $article->images = json_decode($article->images,true); 
                        $article->images = $article->images[0];
                        $data [] = $article; 
                    }
                }
            }
        }
    }
    return view ('cars',['marques' => Fabricant::All(),'categories' => Category::All(),'data' => $data]); 
}); 
Route::post('/contact','Dashboard\MessageController@store')->name('submit'); 
Route::get('/car-details/{id}/{name}',function ($id,$name) {
    $article = Article::find($id);  
    $article->images = json_decode($article->images,true); 
    $article->options = explode(',',$article->options);
    return view('car',['car' => $article]); 
});
Route::get('/gallery',function () {

$articles = Article::All(); 
$images = array(); 
foreach($articles as $article) {
    $article->images = json_decode($article->images,true);
    foreach($article->images as $image) $images[] = $image;  
}
return view('gallery',['images' => $images]); 
});
Auth::routes();


Route::prefix('dashboard')->name('dashboard.')->group(function () {

	$folderDashboard = 'Dashboard';

    // DashboardController
    Route::get('/', $folderDashboard.'\DashboardController@home')->name('home');

    //ProfileController
    Route::get('profile/edit-profile', $folderDashboard.'\ProfileController@index')->name('profile.index');
    Route::post('profile/edit-profile', $folderDashboard.'\ProfileController@index')->name('profile.index');
    Route::get('profile/change-password', $folderDashboard.'\ProfileController@password')->name('profile.password');
    Route::post('profile/change-password', $folderDashboard.'\ProfileController@password')->name('profile.password');

    // UploadController
    Route::post('upload', $folderDashboard.'\UploadController@index')->name('upload');

    // SettingController
    $settingsad = ['site', 'home', 'services','about_us', 'contact','personnel','statistics','testimonial'];
    foreach ($settingsad as $setting) {
        Route::get('settings/'.$setting, $folderDashboard.'\SettingController@'.$setting)->name('settings.'.$setting);
        Route::post('settings/'.$setting, $folderDashboard.'\SettingController@'.$setting)->name('settings.'.$setting);
    }


    // UserController, ClientController, HostingController, MessageController, ServiceController, SliderController, TeamController, WorkController
    $controllers = [
        'users'        => '\UserController',
        'messages'     => '\MessageController',
        'services'     => '\ServiceController',
        'sliders'      => '\SliderController',
        'articles'     => '\ArticleController',
        'categories'   => '\CategoryController',
        'personnel'    => '\PersonneController',
        'partners'     => '\PartnerController',
        'testimonial'  => '\TestimonialController',
        'fabricants'  => '\FabricantController',
    ];
    foreach ($controllers as $prefix => $controller) {
        Route::get($prefix, $folderDashboard.$controller.'@index')->name($prefix.'.index');
        Route::post($prefix, $folderDashboard.$controller.'@index')->name($prefix.'.index');
        Route::get($prefix.'/create', $folderDashboard.$controller.'@create')->name($prefix.'.create');
        Route::post($prefix.'/store', $folderDashboard.$controller.'@store')->name($prefix.'.store');
        Route::get($prefix.'/{id}/edit', $folderDashboard.$controller.'@edit')->name($prefix.'.edit');
        Route::post($prefix.'/{id}/update', $folderDashboard.$controller.'@update')->name($prefix.'.update');
        Route::post($prefix.'/{id}/destroy', $folderDashboard.$controller.'@destroy')->name($prefix.'.destroy');
    }

});

