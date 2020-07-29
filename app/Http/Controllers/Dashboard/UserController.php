<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request, Validator;
use App\User;

class UserController extends Controller
{
    protected $sub = 'dashboard.users';

    protected $menu            = 'Comptes';
    protected $index           = 'Liste des comptes';
    protected $create          = 'Ajouter';
    protected $edit            = 'modifier Compte';
    protected $buttom_create   = 'Ajouter Compte';
    protected $buttom_edit     = 'modifier Compte';
    protected $buttom_destroy  = 'supprimer compte';

    protected $message_destroy = 'supprimer ce compte';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $appends = [];

        $orderKey                      = $request->get('orderKey');
        $orderBy                       = $request->get('orderBy');
        $role                          = $request->get('role');

        $search                        = $request->get('search');

        $orderKeyArray                 = array('id', 'created_at', 'updated_at', 'name', 'email');
        $orderByArray                  = array('asc', 'desc');
        $roleArray                     = array('all', 'admin', 'super-admin');

        $orderKey                      = (!in_array($orderKey, $orderKeyArray) ? "id" : $orderKey);
        $orderBy                       = (!in_array($orderBy, $orderByArray) ? "asc" : $orderBy);
        $role                          = (!in_array($role, $roleArray) ? "all" : $role);

        $data = [
            'page'                     => 'dashboard',
            'menu'                     => $this->menu,
            'submenu'                  => $this->index,
            'create'                   => $this->create,
            'edit'                     => $this->edit,
            'buttom_create'            => $this->buttom_create,
            'buttom_edit'              => $this->buttom_edit,
            'buttom_destroy'           => $this->buttom_destroy,

            'message_destroy'          => $this->message_destroy,

            'sub'                      => $this->sub,
            'orderKey'                 => $orderKey,
            'orderBy'                  => $orderBy,
            'role'                     => $role,
            'search'                   => $search,
            'orderKeyList'             => [
                                            'id'                => 'Id',
                                            'created_at'        => 'date de création',
                                            'updated_at'        => 'Dernier mise à jour',
                                            'name'              => 'nom',
                                            'email'             => 'email'
                                        ],
            'searchList'               => [
                                            'id'                => 1,
                                            'name'              => 2,
                                            'email'             => 2
                                        ],
            'route'                    => route($this->sub.'.index')
        ];

        $appends['orderKey']           = $orderKey;
        $appends['orderBy']            = $orderBy;
        $appends['role']               = $role;

        $view                          = 'index';
        if ($request->ajax()) {
            $view                      = 'data';
        }

        if (!empty($search)) {
            $appends['search']         = $search;
        }

        $lists = User::where(function ($query) use ($data) {
            if ($data['role'] != 'all') {
                $query->where('role', $data['role']);
            }
            if (!empty($data['search'])) {
                $query->where(function ($query) use ($data) {
                    foreach ($data['searchList'] as $key => $value) {
                        if ($value == 1) {
                            $query->where($key, $data['search']);
                        }elseif ($value == 2) {
                            $query->orWhere($key, 'like', '%'.$data['search'].'%');
                        }else {
                            $query->orWhere($key, $data['search']);
                        }
                    }
                });
            }
        })->orderBy($orderKey, $orderBy)->paginate(10);

        $lists->appends($appends);

        return view($data['sub'].'.'.$view, compact(
            'data',
            'lists'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'page'                     => 'dashboard',
            'menu'                     => $this->menu,
            'submenu'                  => $this->create,
            'route'                    => route($this->sub.'.store'),
            'button'                   => $this->buttom_create,
            'role'                     => '',
            'name'                     => '',
            'email'                    => '',
            'password'                 => ''
        ];

        return view($this->sub.'.form', compact(
            'data'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'role'      => 'required|in:admin,super-admin',
            'name'      => 'required',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|confirmed'
        ];

        $validate = Validator::make($request->all(), $rules);

        if ($validate->fails()) {
            $data = [
                'status'    => 'error',
                'message'   => 'Erreurs, vérifer vos données s\'il vous plait!',
                'errors'    => $validate->errors()
            ];
        }else {

            $model                = New User();
            $model->role          = $request->input('role');
            $model->name          = $request->input('name');
            $model->email         = $request->input('email');
            $model->password      = bcrypt($request->input('password'));
            $model->save();

            $data = [
              'status'      => 'success',
              'message'     => 'Compte ajouté !',
              'url'         => route($this->sub.'.index')
            ];
        }

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = User::findOrFail($id);

        $data = [
            'page'                     => 'dashboard',
            'menu'                     => $this->menu,
            'submenu'                  => $this->edit,
            'route'                    => route($this->sub.'.update', $model->id),
            'button'                   => $this->buttom_edit,
            'role'                     => $model->role,
            'name'                     => $model->name,
            'email'                    => $model->email,
            'password'                 => ''
        ];

        return view($this->sub.'.form', compact(
            'data'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $model = User::findOrFail($id);

        $rules = [
            'role'      => 'required|in:admin,super-admin',
            'name'      => 'required',
            'email'     => 'required|email|unique:users,email,'.$model->id
        ];

        if (!empty($request->input('password'))) {
            $rules['password'] = 'required|confirmed';
        }

        $validate = Validator::make($request->all(), $rules);

        if ($validate->fails()) {
            $data = [
                'status'    => 'error',
                'message'   => 'Erreurs, vérifer vos données s\'il vous plait!',
                'errors'    => $validate->errors()
            ];
        }else {

            $model->role          = $request->input('role');
            $model->name          = $request->input('name');
            $model->email         = $request->input('email');
            if (!empty($request->input('password'))) {
                $model->password      = bcrypt($request->input('password'));
            }
            $model->save();

            $data = [
              'status'      => 'success',
              'message'     => 'mise à jour terminé !',
              'url'         => route($this->sub.'.index')
            ];
        }

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = User::findOrFail($id);
        $model->delete();

        $data = [
          'status'      => 'success',
          'message'     => 'le compte a été supprimé avec succés!',
          'url'         => route($this->sub.'.index')
        ];

        return response()->json($data);
    }
}
