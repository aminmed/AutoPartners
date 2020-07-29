<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Setting, Validator;

class SettingController extends Controller
{
    protected $sub            = 'dashboard.settings';
    protected $menu           = 'Paramétrages';
    protected $site           = 'Site paramétrage';
    protected $home           = 'page d\'accueil  paramétrage';
    protected $services       = 'paramétrage des services';
    protected $statistics     = 'paramétrage des statistics';
    protected $personnel      = 'paramétrage du personnel';
    protected $contact        = 'paramétrage du contact';
    protected $about          = 'paramétrage de AboutUs';
    protected $testimonial    = 'paramétrage des Témoignages';
    protected $buttom         = 'Mettre à jour';

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function site(Request $request)
    {
        $data = [
            'page'                     => 'dashboard',
            'menu'                     => $this->menu,
            'submenu'                  => $this->site,
            'button'                   => $this->buttom,
            'sub'                      => $this->sub,
            'route'                    => route($this->sub.'.site')
        ];

        $settingArray = array('title', 'keywords', 'description');
        foreach (Setting::all() as $setting) {
            if (in_array($setting->key, $settingArray)) {
                $data[$setting->key] = $setting->value;
            }
        }

        if ($request->ajax()) {
            $rules = [
                'title'               => 'required',
                'keywords'            => 'required',
                'description'         => 'required'
            ];

            $validate = Validator::make($request->all(), $rules);

            if ($validate->fails()) {
                $data = [
                    'status'     => 'error',
                    'message'    => 'Erreurs, réessayez s\'il vous plait !',
                    'errors'     => $validate->errors()
                ];
            }else {
                foreach ($settingArray as $settingKey) {
                    $update = Setting::where('key', $settingKey)->firstOrFail();
                    if ($settingKey == 'keywords') {
                        $update->value = implode(", ", $request->input($settingKey));
                    }else {
                        $update->value = $request->input($settingKey);
                    }
                    $update->update();
                }

                $data = [
                  'status' => 'success',
                  'message' => 'Mise à jour réussi',
                  'url' => null
                ];
            }

            return response()->json($data);
        }

        return view($this->sub.'.site', compact(
            'data'
        ));
    }

    public function home(Request $request)
    {
        $data = [
            'page'                     => 'dashboard',
            'menu'                     => $this->menu,
            'submenu'                  => $this->home,
            'button'                   => $this->buttom,
            'sub'                      => $this->sub,
            'route'                    => route($this->sub.'.home')
        ];

        $settingArray = array('home');
        foreach (Setting::all() as $setting) {
            if (in_array($setting->key, $settingArray)) {
                $data[$setting->key] = json_decode($setting->value, true);
            }
        }

        if ($request->ajax()) {
            $rules = [
                'home.title'               => 'required'
            ];

            $validate = Validator::make($request->all(), $rules);

            if ($validate->fails()) {
                $data = [
                    'status'     => 'error',
                    'message'    => 'Erreurs, réessayez s\'il vous plait !',
                    'errors'     => $validate->errors()
                ];
            }else {
                foreach ($settingArray as $settingKey) {
                    $update = Setting::where('key', $settingKey)->firstOrFail();
                    $update->value = json_encode($request->input($settingKey));
                    $update->update();
                }

                $data = [
                  'status' => 'success',
                  'message' => 'Mise à jour terminé avec succés !',
                  'url' => null
                ];
            }

            return response()->json($data);
        }

        return view($this->sub.'.home', compact(
            'data'
        ));
    }

    public function services(Request $request)
    {
        $data = [
            'page'                     => 'dashboard',
            'menu'                     => $this->menu,
            'submenu'                  => $this->services,
            'button'                   => $this->buttom,
            'sub'                      => $this->sub,
            'route'                    => route($this->sub.'.services')
        ];

        $settingArray = array('services');
        foreach (Setting::all() as $setting) {
            if (in_array($setting->key, $settingArray)) {
                $data[$setting->key] = json_decode($setting->value, true);
            }
        }

        if ($request->ajax()) {
            $rules = [
                'services.title'               => 'required',
                'services.sub_title'           => 'required',
                'services.home'                => 'required',
            ];

            $validate = Validator::make($request->all(), $rules);

            if ($validate->fails()) {
                $data = [
                    'status'     => 'error',
                    'message'    => 'Erreurs, réessayez s\'il vous plait !',
                    'errors'     => $validate->errors()
                ];
            }else {
                foreach ($settingArray as $settingKey) {
                    $update = Setting::where('key', $settingKey)->firstOrFail();
                    $update->value = json_encode($request->input($settingKey));
                    $update->update();
                }

                $data = [
                  'status' => 'success',
                  'message' => 'Mise à jour terminé avec succés !',
                  'url' => null
                ];
            }

            return response()->json($data);
        }

        return view($this->sub.'.services', compact(
            'data'
        ));
    }

    public function statistics(Request $request)
    {
        $data = [
            'page'                     => 'dashboard',
            'menu'                     => $this->menu,
            'submenu'                  => $this->statistics,
            'button'                   => $this->buttom,
            'sub'                      => $this->sub,
            'route'                    => route($this->sub.'.statistics')
        ];

        $settingArray = array('statistics');
        foreach (Setting::all() as $setting) {
            if (in_array($setting->key, $settingArray)) {
                $data[$setting->key] = json_decode($setting->value, true);
            }
        }

        if ($request->ajax()) {
            $rules = [
                'statistics.clients'             => 'required',
                'statistics.stock'               => 'required',
                'statistics.offices'             => 'required',
                'home'                           => 'required'
            ];

            $validate = Validator::make($request->all(), $rules);

            if ($validate->fails()) {
                $data = [
                    'status'     => 'error',
                    'message'    => 'Erreurs, réessayez s\'il vous plait !',
                    'errors'     => $validate->errors()
                ];
            }else {
                foreach ($settingArray as $settingKey) {
                    $update = Setting::where('key', $settingKey)->firstOrFail();
                    $update->value = json_encode($request->input($settingKey));
                    $update->update();
                }

                $data = [
                  'status'  => 'success',
                  'message' => 'Mise à jour terminé avec succés !',
                  'url' => null
                ];
            }

            return response()->json($data);
        }

        return view($this->sub.'.statistics', compact(
            'data'
        ));
    }

    public function personnel(Request $request)
    {
        $data = [
            'page'                     => 'dashboard',
            'menu'                     => $this->menu,
            'submenu'                  => $this->personnel,
            'button'                   => $this->buttom,
            'sub'                      => $this->sub,
            'route'                    => route($this->sub.'.personnel')
        ];

        $settingArray = array('personnel');
        foreach (Setting::all() as $setting) {
            if (in_array($setting->key, $settingArray)) {
                $data[$setting->key] = json_decode($setting->value, true);
            }
        }

        if ($request->ajax()) {
            $rules = [
                'personnel.title'                  => 'required',
                'personnel.sub_title'              => 'required'
            ];

            $validate = Validator::make($request->all(), $rules);

            if ($validate->fails()) {
                $data = [
                    'status'     => 'error',
                    'message'    => 'Erreurs, réessayez s\'il vous plait !',
                    'errors'     => $validate->errors()
                ];
            }else {
                foreach ($settingArray as $settingKey) {
                    $update = Setting::where('key', $settingKey)->firstOrFail();
                    $update->value = json_encode($request->input($settingKey));
                    $update->update();
                }

                $data = [
                  'status'  => 'success',
                  'message' => 'Mise à jour terminé avec succés !',
                  'url' => null
                ];
            }

            return response()->json($data);
        }

        return view($this->sub.'.personnel', compact(
            'data'
        ));
    }

    public function testimonial(Request $request)
    {
        $data = [
            'page'                     => 'dashboard',
            'menu'                     => $this->menu,
            'submenu'                  => $this->testimonial,
            'button'                   => $this->buttom,
            'sub'                      => $this->sub,
            'route'                    => route($this->sub.'.testimonial')
        ];

        $settingArray = array('testimonial');
        foreach (Setting::all() as $setting) {
            if (in_array($setting->key, $settingArray)) {
                $data[$setting->key] = json_decode($setting->value, true);
            }
        }

        if ($request->ajax()) {
            $rules = [
                'testimonial.title'                   => 'required',
                'testimonial.sub_title'               => 'required',
                'testimonial.home'                    => 'required',
            ];

            $validate = Validator::make($request->all(), $rules);

            if ($validate->fails()) {
                $data = [
                    'status'     => 'error',
                    'message'    => 'Erreurs, réessayez s\'il vous plait !',
                    'errors'     => $validate->errors()
                ];
            }else {
                foreach ($settingArray as $settingKey) {
                    $update = Setting::where('key', $settingKey)->firstOrFail();
                    $update->value = json_encode($request->input($settingKey));
                    $update->update();
                }

                $data = [
                  'status'  => 'success',
                  'message' => 'Mise à jour terminé avec succés !',
                  'url' => null
                ];
            }

            return response()->json($data);
        }

        return view($this->sub.'.testimonial', compact(
            'data'
        ));
    }

    public function contact(Request $request)
    {
        $data = [
            'page'                     => 'dashboard',
            'menu'                     => $this->menu,
            'submenu'                  => $this->contact,
            'button'                   => $this->buttom,
            'sub'                      => $this->sub,
            'route'                    => route($this->sub.'.contact')
        ];

        $settingArray = array('contact');
        foreach (Setting::all() as $setting) {
            if (in_array($setting->key, $settingArray)) {
                $data[$setting->key] = json_decode($setting->value, true);
            }
        }

        if ($request->ajax()) {
            $rules = [
                'contact.company_name'            => 'required',
                'contact.title'                   => 'required',
                'contact.company_domain'          => 'required',
                'contact.address'                 => 'required',
                'contact.map_lat'                 => 'required',
                'contact.map_lng'                 => 'required',
                'contact.email'                   => 'required',
                'contact.phone'                   => 'required',
                'contact.openning'                => 'required',
            ];

            $validate = Validator::make($request->all(), $rules);

            if ($validate->fails()) {
                $data = [
                    'status'     => 'error',
                    'message'    => 'Erreurs, réessayez s\'il vous plait !',
                    'errors'     => $validate->errors()
                ];
            }else {
                foreach ($settingArray as $settingKey) {
                    $update = Setting::where('key', $settingKey)->firstOrFail();
                    $update->value = json_encode($request->input($settingKey));
                    $update->update();
                }

                $data = [
                  'status'  => 'success',
                  'message' => 'Mise à jour terminé avec succés !',
                  'url' => null
                ];
            }

            return response()->json($data);
        }

        return view($this->sub.'.contact', compact(
            'data'
        ));
    }
    public function about_us(Request $request)
    {
        $data = [
            'page'                     => 'dashboard',
            'menu'                     => $this->menu,
            'submenu'                  => $this->contact,
            'button'                   => $this->buttom,
            'sub'                      => $this->sub,
            'route'                    => route($this->sub.'.about_us')
        ];

        $settingArray = array('about_us');
        foreach (Setting::all() as $setting) {
            if (in_array($setting->key, $settingArray)) {
                $data[$setting->key] = json_decode($setting->value, true);
            }
        }

        if ($request->ajax()) {
            $rules = [
                'about_us.image'                      => 'required',
                'about_us.sub_title'                  => 'required',
                'about_us.title'                      => 'required',
                'about_us.description'                => 'required',
            ];

            $validate = Validator::make($request->all(), $rules);

            if ($validate->fails()) {
                $data = [
                    'status'     => 'error',
                    'message'    => 'Erreurs, réessayez s\'il vous plait !',
                    'errors'     => $validate->errors()
                ];
            }else {
                foreach ($settingArray as $settingKey) {
                    $update = Setting::where('key', $settingKey)->firstOrFail();
                    $update->value = json_encode($request->input($settingKey));
                    $update->update();
                }

                $data = [
                  'status'  => 'success',
                  'message' => 'Mise à jour terminé avec succés !',
                  'url' => null
                ];
            }

            return response()->json($data);
        }

        return view($this->sub.'.about_us', compact(
            'data'
        ));
    }
}
