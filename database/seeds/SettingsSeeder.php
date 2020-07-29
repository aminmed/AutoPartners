<?php

use Illuminate\Database\Seeder;
use App\Setting, Carbon\Carbon;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = array(
        	'title'                              => 'AutoPartners',
        	'keywords'                           => 'Auto, Partner, Car',
            'description'                        => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
        	'home'                                  => json_encode(
        		array(
                    'title'                      => 'Accueil'
        		)
            ),
        	'services'                              => json_encode(
        		array(
                    'home'                       => 'yes',
                    'title'                      => 'Nos services',
                    'sub_title'                  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit'                
        		)
            ),
            'personnel'                              => json_encode(
        		array(
                    'home'                       => 'yes',
                    'title'                      => 'Notre équipe',
                    'sub_title'                  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit'                
        		)
        	),
            'statistics'                              => json_encode(
                array(
                    'home'                       => 'yes',
                    'clients'                    => 400,
                    'stock'                      => 350,
                    'offices'                    => 5
                )    
            ),
        	'about_us'                              => json_encode(
        		array(
                    'title'                         => 'Qui somme nous?',
                    'sub_title'                     => 'Lorem ipsum dolor sit amet',
                    'description'                   => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 
                    'image'                         =>  ''
                )
        	),
            'testimonial'                               => json_encode(
                array(
                    'home'                          => 'yes',
                    'title'                         => 'nos clients',
                    'sub_title'                     => 'Lorem ipsum dolor sit amet'
                )
            ),
        	'contact'                               => json_encode(
        		array(
                    'title'                         => 'Contact us',
                    'company_name'                  => 'PES pharma , Turkey',
                    'company_domain'                => 'for general contracting & engineering solutions',
                    'address'                       => '',
        			'map_lat'                       => '',
        			'map_lng'                       => '',
		        	'email'                         => 'test@test.com',
                    'phone'                         => '0552000000',
                    'openning'                      => 'Mon-Fri 09.00 - 17.00',
		        	'networks'                      => array(
                        'facebook'             => '#',
		        		'twitter'              => '#',
                        'instagram'            => '#',
                        'youtupe'              => '#',
		        	)
        		)
        	)
        );

        foreach ($settings as $key => $value) {
        	$new = New Setting();
        	$new->key = $key;
        	$new->value = $value;
            $new->created_at = Carbon::now();
            $new->updated_at = Carbon::now();
        	$new->save();
        }
    }
}
