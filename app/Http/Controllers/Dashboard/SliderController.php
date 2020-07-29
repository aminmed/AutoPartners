<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request, Validator;
use App\Slider;

class SliderController extends Controller
{
    protected $sub = 'dashboard.sliders';

    protected $menu            = 'Sliders';
    protected $index           = 'Liste des sliders';
    protected $create          = 'ajouter slider';
    protected $edit            = 'modifier slider';
    protected $buttom_create   = 'ajouter slider';
    protected $buttom_edit     = 'modifier slider';
    protected $buttom_destroy  = 'supprimer slider';

    protected $message_destroy = 'supprimer ce slider';

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

        $orderKeyArray                 = array('id', 'created_at', 'updated_at');
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
                                            'created_at'        => 'date du creation',
                                            'updated_at'        => 'dernier mise à jour'
                                        ],
            'searchList'               => [
                                            'id'                => 1
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

        $lists = Slider::where(function ($query) use ($data) {
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
            'image'                    => '',
            'home'                     => '',
            'text'                     => '',
            'title'                    => '',
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
            'title'      => 'required',
            'text'       => 'required',
            'home'       => 'required',
            'image'      => 'required'
        ];

        $validate = Validator::make($request->all(), $rules);

        if ($validate->fails()) {
            $data = [
                'status'    => 'error',
                'message'   => 'There are some errors please review it!',
                'errors'    => $validate->errors()
            ];
        }else {

            $model                       = New Slider();
            $model->image                = $request->input('image');
            $model->title                = $request->input('title');
            $model->text                 = $request->input('text');
            $model->home                 = ($request->input('home') == 'on') ? 'yes' : 'no';
            $model->save();

            $data = [
              'status'      => 'success',
              'message'     => 'element add was completely successful',
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
        $model = Slider::findOrFail($id);

        $data = [
            'page'                     => 'dashboard',
            'menu'                     => $this->menu,
            'submenu'                  => $this->edit,
            'route'                    => route($this->sub.'.update', $model->id),
            'button'                   => $this->buttom_edit,
            'home'                     => $model->home,
            'image'                    => $model->image,
            'title'                    => $model->title,
            'text'                     => $model->text
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
        $model = Slider::findOrFail($id);

        $rules = [
            'title'      => 'required',
            'text'       => 'required',
            'home'       => 'required',
            'image'      => 'required'
        ];



        $validate = Validator::make($request->all(), $rules);

        if ($validate->fails()) {
            $data = [
                'status'    => 'error',
                'message'   =>'there are some errors, please review it!',
                'errors'    => $validate->errors()
            ];
        }else {

            $model->home                 = ($request->input('home') == 'on') ? 'yes' : 'no';
            $model->image                = $request->input('image');
            $model->title                = $request->input('title');
            $model->text                 = $request->input('text');
            $model->save();

            $data = [
              'status'      => 'success',
              'message'     => 'element was added successfully !',
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
        $model = Slider::findOrFail($id);
        $model->delete();

        $data = [
          'status'      => 'success',
          'message'     => 'element was deleted !',
          'url'         => route($this->sub.'.index')
        ];

        return response()->json($data);
    }
}
