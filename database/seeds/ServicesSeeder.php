<?php

use Illuminate\Database\Seeder;
use App\Service,Carbon\Carbon;
class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $service               = new Service();
       $service->home         = 'yes';
       $service->title_en     = 'Dossier';
       $service->text_en      = 'Choice of products with sourcing of the technology and dossiers.';
       $service->title_en     = 'Dossier';
       $service->icon         = asset('images/services/1.png');
       $service->created_at   = Carbon::now()->subDays(3);
       $service->updated_at   = Carbon::now()->subDays(3);
       $service->save();
       $service               = new Service();
       $service->home         = 'yes';
       $service->title_en     = 'Dossier';
       $service->text_en      = 'Choice of products with sourcing of the technology and dossiers.';
       $service->title_en     = 'Dossier';
       $service->icon         = asset('images/services/2.png');
       $service->created_at   = Carbon::now()->subDays(3);
       $service->updated_at   = Carbon::now()->subDays(3);
       $service->save();
       $service               = new Service();
       $service->home         = 'yes';
       $service->title_en     = 'Dossier';
       $service->text_en      = 'Choice of products with sourcing of the technology and dossiers.';
       $service->title_en     = 'Dossier';
       $service->icon         = asset('images/services/3.png');
       $service->created_at   = Carbon::now()->subDays(3);
       $service->updated_at   = Carbon::now()->subDays(3);
       $service->save();
       $service               = new Service();
       $service->home         = 'yes';
       $service->title_en     = 'Dossier';
       $service->text_en      = 'Choice of products with sourcing of the technology and dossiers.';
       $service->title_en     = 'Dossier';
       $service->icon         = asset('images/services/4.png');
       $service->created_at   = Carbon::now()->subDays(3);
       $service->updated_at   = Carbon::now()->subDays(3);
       $service->save();
       $service               = new Service();
       $service->home         = 'no';
       $service->title_en     = 'Dossier';
       $service->text_en      = 'Choice of products with sourcing of the technology and dossiers.';
       $service->title_en     = 'Dossier';
       $service->icon         = asset('images/services/5.png');
       $service->created_at   = Carbon::now()->subDays(3);
       $service->updated_at   = Carbon::now()->subDays(3);
       $service->save();
    }
}
