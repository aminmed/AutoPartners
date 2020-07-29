<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Article , App\Category , App\Fabricant;
use Illuminate\Http\Request, Validator;

class ArticleController extends Controller
{
    protected $sub = 'dashboard.articles';

    protected $menu            = 'Articles';
    protected $index           = 'liste des articles';
    protected $create          = 'Ajouter article';
    protected $edit            = 'modifier article';
    protected $buttom_create   = 'Ajouter article';
    protected $buttom_edit     = 'modifier article';
    protected $buttom_destroy  = 'supprimer article';

    protected $message_destroy = 'supprimer cet article';

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
        $orderKeyArray                 = array('id', 'created_at', 'updated_at', 'title');
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
                                            'title'              => 'nom'
                                        ],
            'searchList'               => [
                                            'id'             => 1,
                                            'title'          => 2
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

        $lists = Article::where(function ($query) use ($data) {
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
            'title'                    => '',
            'category'                 => '',
            'fabricant'                => '',
            'version'                  => '',
            'puissance'                => '',
            'energie'                  => '',
            'kilometrage'              => '',
            'millesime'                => '',
            'boite'                    => '',
            'nbPortes'                 => '',
            'dateCirculation'          => '',
            'couleur'                  => '',
            'premiereMain'             => '',
            'description'              => '',
            'keywords'                 => '',
            'images'                   => '', 
            'prix'                     => '',
            'promotion'                => '',
            'video'                    => '',
            'options'                  => '',

        ];
            $categories = Category::All();
            $fabricants  = Fabricant::All();
        return view($this->sub.'.form', compact(
            'data', 'categories', 'fabricants'
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
            'home'                     => 'required',
            'title'                    => 'required',
            'category'                 => 'required',
            'fabricant'                => 'required',
            'version'                  => 'required',
            'puissance'                => 'required',
            'energie'                  => 'required',
            'kilometrage'              => 'required',
            'millesime'                => 'required',
            'boite'                    => 'required',
            'nbPortes'                 => 'required',
            'dateCirculation'          => 'required',
            'couleur'                  => 'required',
            'premiereMain'             => 'required',
            'description'              => 'required',
            'keywords'                 => 'required',
            'images'                   => 'required', 
            'prix'                     => 'required',
            'promotion'                => 'required',
            'options'                  => 'required',
        ];

        $validate = Validator::make($request->all(), $rules);

        if ($validate->fails()) {
            $data = [
                'status'    => 'error',
                'message'   => 'Erreur, réessayez S\'il vous plait!',
                'errors'    => $validate->errors()
            ];
        }else {

            $model                 = New Article();
            $model->home           = ($request->input('home') == 'on') ? 'yes' : 'no';
            $model->title          = $request->input('title');
            $model->version        = $request->input('version');
            $model->puissance      = $request->input('puissance');
            $model->energie        = $request->input('energie');
            $model->boite          = $request->input('boite');
            $model->premiereMain   = $request->input('premiereMain');
            $model->couleur        = $request->input('couleur');
            $model->dateCirculation= $request->input('dateCirculation');
            $model->nbPortes       = $request->input('nbPortes');
            $model->kilometrage    = $request->input('kilometrage'); 
            $model->millesime      = $request->input('millesime');
            $model->prix           = $request->input('prix');
            $model->promotion      = $request->input('promotion');
            $model->images         = json_encode($request->input('images'),true);
            $model->options        = implode(", ",$request->input('options'));
            $model->description    = $request->input('description');
            $model->keywords       = implode(", ", $request->input('keywords'));
            $model->category_id    = $request->input('category');
            $model->fabricant_id   = $request->input('fabricant');
            $model->save();

            $data = [
              'status'      => 'success',
              'message'     => 'article  à été ajouté avec succés !',
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
        $model = Article::findOrFail($id);

        $data = [
            'page'                     => 'dashboard',
            'menu'                     => $this->menu,
            'submenu'                  => $this->edit,
            'route'                    => route($this->sub.'.update', $model->id),
            'button'                   => $this->buttom_edit,
            'home'                     => $model->home ,
            'title'                    => $model->title ,
            'version'                  => $model->version ,
            'puissance'                => $model->puissance ,
            'energie'                  => $model->energie ,
            'kilometrage'              => $model->kilometrage ,
            'millesime'                => $model->millesime ,
            'boite'                    => $model->boite ,
            'nbPortes'                 => $model->nbPortes ,
            'dateCirculation'          => $model->dateCirculation ,
            'couleur'                  => $model->couleur ,
            'premiereMain'             => $model->premiereMain ,
            'description'              => $model->description ,
            'keywords'                 => $model->keywords ,
            'images'                   => json_decode($model->images,true) , 
            'prix'                     => $model->prix ,
            'promotion'                => $model->promotion ,
            'options'                  => $model->options ,
        ];
        $categories = Category::All(); 
        $fabricants = Fabricant::All(); 
        return view($this->sub.'.form', compact(
            'data', 'categories', 'fabricants'
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
        $model = Article::findOrFail($id);

        $rules = [
            'home'                     => 'required',
            'title'                    => 'required',
            'category'                 => 'required',
            'fabricant'                => 'required',
            'version'                  => 'required',
            'puissance'                => 'required',
            'energie'                  => 'required',
            'kilometrage'              => 'required',
            'millesime'                => 'required',
            'boite'                    => 'required',
            'nbPortes'                 => 'required',
            'dateCirculation'          => 'required',
            'couleur'                  => 'required',
            'premiereMain'             => 'required',
            'description'              => 'required',
            'keywords'                 => 'required',
            'images'                   => 'required', 
            'prix'                     => 'required',
            'promotion'                => 'required',
            'options'                  => 'required',
        ];

        $validate = Validator::make($request->all(), $rules);

        if ($validate->fails()) {
            $data = [
                'status'    => 'error',
                'message'   => 'Erreur, réessayez S\'il vous plait!',
                'errors'    => $validate->errors()
            ];
        }else {

            $model->home           = ($request->input('home') == 'on') ? 'yes' : 'no';
            $model->title          = $request->input('title');
            $model->version        = $request->input('version');
            $model->puissance      = $request->input('puissance');
            $model->energie        = $request->input('energie');
            $model->boite          = $request->input('boite');
            $model->premiereMain   = $request->input('premiereMain');
            $model->couleur        = $request->input('couleur');
            $model->dateCirculation= $request->input('dateCirculation');
            $model->nbPortes       = $request->input('nbPortes');
            $model->kilometrage    = $request->input('kilometrage'); 
            $model->millesime      = $request->input('millesime');
            $model->prix           = $request->input('prix');
            $model->promotion      = $request->input('promotion');
            $model->images         = json_encode($request->input('images'),true);
            $model->options        = implode(", ",$request->input('options'));
            $model->description    = $request->input('description');
            $model->keywords       = implode(", ", $request->input('keywords'));
            $model->category_id    = $request->input('category');
            $model->fabricant_id   = $request->input('fabricant');
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
        $model = Article::findOrFail($id);
        $model->delete();
        $data = [
          'status'      => 'success',
          'message'     => 'suppression a été effectuée avec succés ',
          'url'         => route($this->sub.'.index')
        ];

        return response()->json($data);
    }
}
