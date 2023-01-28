<?php

namespace Webkul\Attribute\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttributeOptionTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('attribute_options')->delete();

        DB::table('attribute_option_translations')->delete();

        DB::table('attribute_options')->insert([
            [
                'id'           => '1',
                'admin_name'   => 'Red',
                'sort_order'   => '1',
                'attribute_id' => '23',
            ], [
                'id'           => '2',
                'admin_name'   => 'Green',
                'sort_order'   => '2',
                'attribute_id' => '23',
            ], [
                'id'           => '3',
                'admin_name'   => 'Yellow',
                'sort_order'   => '3',
                'attribute_id' => '23',
            ], [
                'id'           => '4',
                'admin_name'   => 'Black',
                'sort_order'   => '4',
                'attribute_id' => '23',
            ], [
                'id'           => '5',
                'admin_name'   => 'White',
                'sort_order'   => '5',
                'attribute_id' => '23',
            ], [
                'id'           => '6',
                'admin_name'   => 'S',
                'sort_order'   => '1',
                'attribute_id' => '24',
            ], [
                'id'           => '7',
                'admin_name'   => 'M',
                'sort_order'   => '2',
                'attribute_id' => '24',
            ], [
                'id'           => '8',
                'admin_name'   => 'L',
                'sort_order'   => '3',
                'attribute_id' => '24',
            ], [
                'id'           => '9',
                'admin_name'   => 'XL',
                'sort_order'   => '4',
                'attribute_id' => '24',
            ],
            [
                'id'           => '10',
                'admin_name'   => 'Shaka',
                'sort_order'   => '1',
                'attribute_id' => '25',
            ],
            [
                'id'           => '11',
                'admin_name'   => 'Katarina Zlajić',
                'sort_order'   => '2',
                'attribute_id' => '25',
            ],
            [
                'id'           => '12',
                'admin_name'   => 'Gift Card',
                'sort_order'   => '3',
                'attribute_id' => '25',
            ],
            [
                'id'           => '13',
                'admin_name'   => 'Made to order',
                'sort_order'   => '4',
                'attribute_id' => '25',
            ],
            [
                'id'           => '14',
                'admin_name'   => 'Sale',
                'sort_order'   => '5',
                'attribute_id' => '25',
            ],
            [
                'id'           => '15',
                'admin_name'   => 'Cotton',
                'sort_order'   => '1',
                'attribute_id' => '28',
            ],
            [
                'id'           => '16',
                'admin_name'   => 'Linen',
                'sort_order'   => '2',
                'attribute_id' => '28',
            ],
            [
                'id'           => '17',
                'admin_name'   => 'Hemp',
                'sort_order'   => '3',
                'attribute_id' => '28',
            ],
            [
                'id'           => '18',
                'admin_name'   => 'Zip',
                'sort_order'   => '4',
                'attribute_id' => '28',
            ]

        ]);

        DB::table('attribute_option_translations')->insert([
            [
                'id'                  => '1',
                'locale'              => 'en',
                'label'               => 'Red',
                'attribute_option_id' => '1',
            ], [
                'id'                  => '2',
                'locale'              => 'en',
                'label'               => 'Green',
                'attribute_option_id' => '2',
            ], [
                'id'                  => '3',
                'locale'              => 'en',
                'label'               => 'Yellow',
                'attribute_option_id' => '3',
            ], [
                'id'                  => '4',
                'locale'              => 'en',
                'label'               => 'Black',
                'attribute_option_id' => '4',
            ], [
                'id'                  => '5',
                'locale'              => 'en',
                'label'               => 'White',
                'attribute_option_id' => '5',
            ], [
                'id'                  => '6',
                'locale'              => 'en',
                'label'               => 'S',
                'attribute_option_id' => '6',
            ], [
                'id'                  => '7',
                'locale'              => 'en',
                'label'               => 'M',
                'attribute_option_id' => '7',
            ], [
                'id'                  => '8',
                'locale'              => 'en',
                'label'               => 'L',
                'attribute_option_id' => '8',
            ], [
                'id'                  => '9',
                'locale'              => 'en',
                'label'               => 'XL',
                'attribute_option_id' => '9',
            ],
            [
                'id'                  => '10',
                'locale'              => 'en',
                'label'               => 'Shaka',
                'attribute_option_id' => '10',
            ],
            [
                'id'                  => '11',
                'locale'              => 'en',
                'label'               => 'Katarina Zlajić',
                'attribute_option_id' => '11',
            ],
            [
                'id'                  => '12',
                'locale'              => 'en',
                'label'               => 'Gift Card',
                'attribute_option_id' => '12',
            ],
            [
                'id'                  => '13',
                'locale'              => 'en',
                'label'               => 'Made to order',
                'attribute_option_id' => '13',
            ],
            [
                'id'                  => '14',
                'locale'              => 'en',
                'label'               => 'Sale',
                'attribute_option_id' => '14',
            ],
            [
                'id'                  => '15',
                'locale'              => 'en',
                'label'               => 'Cotton',
                'attribute_option_id' => '15',
            ],
            [
                'id'                  => '16',
                'locale'              => 'en',
                'label'               => 'Linen',
                'attribute_option_id' => '16',
            ],
            [
                'id'                  => '17',
                'locale'              => 'en',
                'label'               => 'Hemp',
                'attribute_option_id' => '17',
            ],
            [
                'id'                  => '18',
                'locale'              => 'en',
                'label'               => 'Zip',
                'attribute_option_id' => '18',
            ]
        ]);
    }
}