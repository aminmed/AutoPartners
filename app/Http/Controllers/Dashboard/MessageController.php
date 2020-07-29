<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request, Validator;
use App\Message;

class MessageController extends Controller
{
    protected $sub = 'dashboard.messages';

    protected $menu            = 'Messages';
    protected $index           = 'Liste Messages';
    protected $create          = 'Ajouter message';
    protected $edit            = 'marquer comme lu';
    protected $buttom_create   = 'Ajoute message';
    protected $buttom_edit     = 'marquer comme lu';
    protected $buttom_destroy  = 'supprimer message';

    protected $message_destroy = 'supprimer ce message';

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

        $orderKeyArray                 = array('id', 'created_at', 'updated_at', 'name', 'email','subject');
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
                                            'created_at'        =>  'date de creation',
                                            'updated_at'        => 'dernier modification',
                                            'email'             => 'email',
                                            'name'              => 'nom',
                                            'subject'           =>  'objet'
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

        $view                          = 'index';
        if ($request->ajax()) {
            $view                      = 'data';
        }

        if (!empty($search)) {
            $appends['search']         = $search;
        }

        $lists = Message::where(function ($query) use ($data) {
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
            'name'                     => '',
            'email'                    => '',
            'subject'                  => '',
            'text'                     => ''
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
            'name'          => 'required',
            'email'         => 'required',
            'subject'       => 'required',
            'message'       => 'required'
        ];

        $validate = Validator::make($request->all(), $rules);

        if ($validate->fails()) {
            $data = [
                'status'    => 'error',
                'message'   => 'Erreurs, réessayez s\'il vous plait!',
                'errors'    => $validate->errors()
            ];
        }else {

            $model                = New Message();
            $model->name          = $request->input('name');
            $model->email         = $request->input('email');
            $model->subject       = $request->input('subject');
            $model->text          = $request->input('message');
            $model->read          = 'no';
            $model->save();

            $data = [
              'status'      => 'success',
              'message'     => 'méssage envoyé!',
            ];
        }

        return back()->with('success','Message a été envoyé avec succés!');
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Message::findOrFail($id);
        $model->read = "yes";
        $model->save();
        return redirect()->route('dashboard.messages.index',['dashboard.messages.index']);
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
        $model = Message::findOrFail($id);

        $rules = [
            'email'         => 'required',
            'name'          => 'required',
            'subject'       => 'required',
            'text_en'       => 'required'
        ];

        $validate = Validator::make($request->all(), $rules);

        if ($validate->fails()) {
            $data = [
                'status'    => 'error',
                'message'   => 'Erreurs, réessayez s\'il vous plait!',
                'errors'    => $validate->errors()
            ];
        }else {

            $model->email         = $request->input('email');
            $model->name          = $request->input('name');
            $model->subject       = $request->input('subject');
            $model->text_en       = $request->input('text_en');
            $model->save();

            $data = [
              'status'      => 'success',
              'message'     => 'Mise à jour terminé avec succés !',
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
        $model = Message::findOrFail($id);
        $model->delete();

        $data = [
          'status'      => 'success',
          'message'     => 'element supprimé avec succés!',
          'url'         => route($this->sub.'.index')
        ];

        return response()->json($data);
    }
}
