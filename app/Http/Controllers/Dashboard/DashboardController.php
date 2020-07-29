<?php

namespace App\Http\Controllers\Dashboard;
use App\User, App\Category, App\Message, App\Service, App\Testimonial, App\Article;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function home()
    {
        $data = [
            'page'                     => 'dashboard.home',
            'menu'                     => 'page d\'accueil',
            'submenu'                  => ''
        ];

        $counts['counts']          = [];
        $counts['users']           = User::all()->count();
        $counts['messages']        = Message::all()->count();
        $counts['services']        = Service::all()->count();
        $counts['articles']        = Article::all()->count();
        $counts['testimonial']     = Testimonial::all()->count();
        $counts['categories']      = Category::all()->count();


        return view('dashboard.home', compact(
            'data',
            'counts'
        ));
    }
}
