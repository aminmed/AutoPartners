<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Personne;
use Illuminate\Http\Request, Validator;

class PersonneController extends Controller
{
    protected $sub = 'dashboard.personnel';

    protected $menu            = 'Personnes';
    protected $index           = 'liste du personnel';
    protected $create          = 'Ajouter personne';
    protected $edit            = 'modifier personne';
    protected $buttom_create   = 'Ajouter personne';
    protected $buttom_edit     = 'modifier personne';
    protected $buttom_destroy  = 'supprimer personne';

    protected $message_destroy = 'supprimer cette personne';

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
        $orderKeyArray                 = array('id', 'created_at', 'updated_at', 'name');
        $orderByArray                  = array('asc', 'desc');

        $orderKey                      = (!in_array($orderKey, $orderKeyArray) ? "id" : $orderKey);
        $orderBy                       = (!in_array($orderBy, $orderByArray) ? "asc" : $orderBy);

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
            'search'                   => $search,
            'orderKeyList'             => [
                                            'id'                => 'Id',
                                            'created_at'        => 'date de création',
                                            'updated_at'        => 'dernier mise à jour',
                                            'name'              => 'Nom du membre'
                                        ],
            'searchList'               => [
                                            'id'              => 1,
                                            'name'            => 2
                                        ],
            'route'                    => route($this->sub.'.index')
        ];

        $appends['orderKey']           = $orderKey;
        $appends['orderBy']            = $orderBy;

        $view                          = 'index';
        if ($request->ajax()) {
            $view                      = 'data';
        }

        if (!empty($search)) {
            $appends['search']         = $search;
        }

        $lists = Personne::where(function ($query) use ($data) {
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
            'home'                     => '',
            'name'                     => '',
            'photo'                    => '',
            'description'              => '',
            'contact'                  => '',
            'role'                     => '',
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
            'name'                 => 'required',
            'photo'                => 'required',
            'description'          => 'required'
        ];

        $validate = Validator::make($request->all(), $rules);

        if ($validate->fails()) {
            $data = [
                'status'    => 'error',
                'message'   => 'Erreur, réessayez S\'il vous plait!',
                'errors'    => $validate->errors()
            ];
        }else {
                
            $model                = New Personne();
            $model->home          = ($request->input('home') == 'on') ? 'yes' : 'no';
            $model->name          = $request->input('name');
            $model->role          = $request->input('role');
            $model->photo         = $request->input('photo');
            $model->description   = $request->input('description');
            $model->contact       = json_encode($request->input('contact'),true);
            $model->save();
            $data = [
              'status'      => 'success',
              'message'     => 'le mise à joue à été effectué avec succés !',
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
        $model = Personne::findOrFail($id);

        $data = [
            'page'                     => 'dashboard',
            'menu'                     => $this->menu,
            'submenu'                  => $this->edit,
            'route'                    => route($this->sub.'.update', $model->id),
            'button'                   => $this->buttom_edit,
            'home'                     => $model->home,
            'name'                     => $model->name,
            'photo'                     => $model->photo,
            'role'                     => $model->role,
            'description'              => $model->description,
            'contact'                  => json_decode($model->contact)
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
        $model = Personne::findOrFail($id);

        $rules = [
            'name'          => 'required',
            'photo'         => 'required',
            'description'   => 'required',
            'contact'       => 'required'
        ];

        $validate = Validator::make($request->all(), $rules);

        if ($validate->fails()) {
            $data = [
                'status'    => 'error',
                'message'   => 'Erreur, réessayez S\'il vous plait!',
                'errors'    => $validate->errors()
            ];
        }else {

            $model->home          = ($request->input('home') == 'on') ? 'yes' : 'no';
            $model->name          = $request->input('name');
            $model->role          = $request->input('role');
            $model->photo         = $request->input('photo');
            $model->description   = $request->input('description');
            $model->contact       = json_encode($request->input('contact'),true);
            $model->save();

            $data = [
              'status'      => 'success',
              'message'     => 'le mise à joue à été effectué avec succés !',
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
        $model = Personne::findOrFail($id);
        $model->delete();

        $data = [
          'status'      => 'success',
          'message'     => 'suppression a été effectuée avec succés ',
          'url'         => route($this->sub.'.index')
        ];

        return response()->json($data);
    }
}