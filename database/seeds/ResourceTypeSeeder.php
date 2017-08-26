<?php

use Illuminate\Database\Seeder;
use App\Models\ResourceType;

class ResourceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ResourceType::truncate();

        ResourceType::create([
            'name' => 'Admin Server',
            'category' => 'Asset Locations',
            'icon' => 'fa-paint-brush',
            'color' => 'e31a52',
        ]);

        ResourceType::create([
            'name' => 'Design Server',
            'category' => 'Asset Locations',
            'icon' => 'fa-paint-brush',
            'color' => 'e31a52',
        ]);

        ResourceType::create([
            'name' => 'Spreadsheet',
            'category' => 'GoogleDocs',
            'icon' => 'fa-file-o',
            'color' => '24ad28',
        ]);

        ResourceType::create([
            'name' => 'Slideshow',
            'category' => 'GoogleDocs',
            'icon' => 'fa-file-o',
            'color' => '24ad28',
        ]);

        ResourceType::create([
            'name' => 'Document',
            'category' => 'GoogleDocs',
            'icon' => 'fa-file-o',
            'color' => '24ad28',
        ]);

        ResourceType::create([
            'name' => 'Basecamp Project',
            'category' => 'Links',
            'icon' => 'fa-link',
            'color' => '4BA2C9',
        ]);

        ResourceType::create([
            'name' => 'LastPass Record',
            'category' => 'Links',
            'icon' => 'fa-link',
            'color' => '4BA2C9',
        ]);

        ResourceType::create([
            'name' => 'Trello Board',
            'category' => 'Links',
            'icon' => 'fa-link',
            'color' => '4BA2C9',
        ]);

        ResourceType::create([
            'name' => 'Website - Other',
            'category' => 'Links',
            'icon' => 'fa-link',
            'color' => '4BA2C9',
        ]);

        ResourceType::create([
            'name' => 'Client Services Team',
            'category' => 'People',
            'icon' => 'fa-user',
            'color' => '8e39a3',
        ]);

        ResourceType::create([
            'name' => 'Creative Team',
            'category' => 'People',
            'icon' => 'fa-user',
            'color' => '8e39a3',
        ]);

        ResourceType::create([
            'name' => 'Digital Team',
            'category' => 'People',
            'icon' => 'fa-user',
            'color' => '8e39a3',
        ]);

        ResourceType::create([
            'name' => 'Strategy & Planning Team',
            'category' => 'People',
            'icon' => 'fa-user',
            'color' => '8e39a3',
        ]);
    }
}
