<?php

namespace Database\Seeders;

use App\Models\BuilderMenu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list = [
            ['name'=>'Website', 'url'=>'website'],
            ['name'=>'Hosting', 'url'=>'hosting'],
            ['name'=>'Server', 'url'=>'server'],
            ['name'=>'Services', 'url'=>'services'],
            ['name'=>'Blog', 'url'=>'blog'],
            ['name'=>'Contact Us', 'url'=>'contact'],

        ];

        foreach ($list as $key => $item) {
            BuilderMenu::create([
                'name' => $item['name'],
                'url' => $item['url'],
                'position' => $key,
            ]);
        }
    }
}
