<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Testimonial;
use Illuminate\Http\Request, Validator;

class TestimonialController extends Controller
{
    protected $sub = 'dashboard.testimonial';

    protected $menu            = 'Témoignages';
    protected $index           = 'liste des témoignages';
    protected $create          = 'Ajouter témoignage';
    protected $edit            = 'modifier témoignage';
    protected $buttom_create   = 'Ajouter témoignage';
    protected $buttom_edit     = 'modifier témoignage';
    protected $buttom_destroy  = 'supprimer témoignage';

    protected $message_destroy = 'supprimer ce témoignage';

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
        $orderKeyArray                 = array('id', 'created_at', 'updated_at','client_name');
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
                                            'client_name'       => 'client'
                                        ],
            'searchList'               => [
                                            'id'             => 1,
                                            'client_name'    => 2
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

        $lists = Testimonial::where(function ($query) use ($data) {
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
            'client_name'              => '',
            'client_photo'             => '',
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
            'client_name'   => 'required',
            'client_photo'  => 'required',
            'text'          => 'required'
        ];

        $validate = Validator::make($request->all(), $rules);

        if ($validate->fails()) {
            $data = [
                'status'    => 'error',
                'message'   => 'Erreur, réessayez S\'il vous plait!',
                'errors'    => $validate->errors()
            ];
        }else {

            $model                = New Testimonial();
            $model->home          = ($request->input('home') == 'on') ? 'yes' : 'no';
            $model->client_name   = $request->input('client_name');
            $model->client_photo  = $request->input('client_photo');
            $model->text          = $request->input('text');
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
        $model = Testimonial::findOrFail($id);

        $data = [
            'page'                     => 'dashboard',
            'menu'                     => $this->menu,
            'submenu'                  => $this->edit,
            'route'                    => route($this->sub.'.update', $model->id),
            'button'                   => $this->buttom_edit,
            'home'                     => $model->home,
            'client_name'              => $model->client_name,
            'client_photo'             => $model->client_photo,
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
        $model = Testimonial::findOrFail($id);

        $rules = [
            'client_name'   => 'required',
            'client_photo'  => 'required',
            'text'          => 'required'
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
            $model->client_name   = $request->input('client_name');
            $model->client_photo  = $request->input('client_photo');
            $model->text          = $request->input('text');
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
        $model = Testimonial::findOrFail($id);
        $model->delete();

        $data = [
          'status'      => 'success',
          'message'     => 'suppression a été effectuée avec succés ',
          'url'         => route($this->sub.'.index')
        ];

        return response()->json($data);
    }
}
