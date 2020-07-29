<?php

use Illuminate\Database\Seeder;
use App\Slider,Carbon\Carbon;
class SlidersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $slider                         = new Slider();
        $slider->slider_title_en        = 'PES PHARMA';
        $slider->slider_text_en         = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum'; 
        $slider->link                   = asset('images/about.jpg');
        $slider->created_at             = Carbon::now()->subDays(3);
        $slider->updated_at             = Carbon::now()->subDays(3);
        $slider->save();
        $slider                         = new Slider();
        $slider->slider_title_en        = 'PES PHARMA';
        $slider->slider_text_en         = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum'; 
        $slider->link                   = asset('images/slide.jpg');
        $slider->created_at             = Carbon::now()->subDays(3);
        $slider->updated_at             = Carbon::now()->subDays(3);
        $slider->save();
        $slider                         = new Slider();
        $slider->slider_title_en        = 'PES PHARMA';
        $slider->slider_text_en         = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum'; 
        $slider->link                   = asset('images/about.jpg');
        $slider->created_at             = Carbon::now()->subDays(3);
        $slider->updated_at             = Carbon::now()->subDays(3);
        $slider->save();
        $slider                         = new Slider();
        $slider->slider_title_en        = 'PES PHARMA';
        $slider->slider_text_en         = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum'; 
        $slider->link                   = asset('images/slide.jpg');
        $slider->created_at             = Carbon::now()->subDays(3);
        $slider->updated_at             = Carbon::now()->subDays(3);
        $slider->save();
    }
}
