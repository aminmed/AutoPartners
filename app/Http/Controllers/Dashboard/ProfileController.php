<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request, Validator;
use App\User, Auth;

class ProfileController extends Controller
{
    protected $sub = 'dashboard.profile';

    protected $menu           = 'profil';
    protected $index          = 'profil';
    protected $password       = 'Changer mot de passe';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = [
            'page'                     => 'profil',
            'menu'                     => $this->menu,
            'submenu'                  => '',

            'sub'                      => $this->sub,

            'route'                    => route($this->sub.'.index'),
            'name'                     => Auth::user()->name,
            'email'                    => Auth::user()->email
        ];

        if ($request->ajax()) {
            $rules = [
                'name'      => 'required|min:4|max:40',
                'email'     => 'required|email|unique:users,email,'.Auth::user()->id
            ];

            $validate = Validator::make($request->all(), $rules);

            if ($validate->fails()) {
                $data = [
                    'status'   => 'error',
                    'message'  => 'Erreurs, réessayez s\'il vous plait !',
                    'errors'   => $validate->errors()
                ];
            }else {
                $update           = User::findOrFail(Auth::user()->id);
                $update->name     = $request->input('name');
                $update->update();

                $data = [
                  'status' => 'success',
                  'message' => 'Mise à jour terminé avec succés !',
                  'url' => null
                ];
            }

            return response()->json($data);
        }

        return view($this->sub.'.index', compact(
            'data'
        ));
    }

    public function password(Request $request)
    {
        $data = [
            'page'                     => 'profil',
            'menu'                     => $this->menu,
            'submenu'                  => $this->password,
            'sub'                      => $this->sub,
            'route'                    => route($this->sub.'.password')
        ];

        if ($request->ajax()) {
            $rules = [
                'password_old'   => 'required',
                'password'       => 'required|confirmed|min:6|max:30'
            ];

            $validate = Validator::make($request->all(), $rules);

            $validate->after(function ($validate) use ($request) {
                if (!password_verify($request->input('password_old'), Auth::user()->password)) {
                    $validate->errors()->add('password_old','old password is not correct');
                }
            });

            if ($validate->fails()) {
                $data = [
                    'status'   => 'error',
                    'message'  => 'There are some errors please review it !',
                    'errors'   => $validate->errors()
                ];
            }else {
                $update           = User::findOrFail(Auth::user()->id);
                $update->password = bcrypt($request->input('password'));
                $update->update();

                $data = [
                  'status' => 'success',
                  'message' => 'Mise à jour terminé avec succés !',
                  'url' => null
                ];
            }

            return response()->json($data);
        }

        return view($this->sub.'.password', compact(
            'data'
        ));
    }
}
