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
            'color' => 'e31a52',
        ]);

        ResourceType::create([
            'name' => 'Design Server',
            'category' => 'Asset Locations',
            'color' => 'e31a52',
        ]);

        ResourceType::create([
            'name' => 'Spreadsheet',
            'category' => 'GoogleDocs',
            'color' => '24ad28',
        ]);

        ResourceType::create([
            'name' => 'Slideshow',
            'category' => 'GoogleDocs',
            'color' => '24ad28',
        ]);

        ResourceType::create([
            'name' => 'Document',
            'category' => 'GoogleDocs',
            'color' => '24ad28',
        ]);

        ResourceType::create([
            'name' => 'Basecamp Project',
            'category' => 'Links',
            'color' => '4BA2C9',
        ]);

        ResourceType::create([
            'name' => 'LastPass Record',
            'category' => 'Links',
            'color' => '4BA2C9',
        ]);

        ResourceType::create([
            'name' => 'Trello Board',
            'category' => 'Links',
            'color' => '4BA2C9',
        ]);

        ResourceType::create([
            'name' => 'Website - Other',
            'category' => 'Links',
            'color' => '4BA2C9',
        ]);

        ResourceType::create([
            'name' => 'Client Services Team',
            'category' => 'People',
            'color' => '8e39a3',
        ]);

        ResourceType::create([
            'name' => 'Creative Team',
            'category' => 'People',
            'color' => '8e39a3',
        ]);

        ResourceType::create([
            'name' => 'Digital Team',
            'category' => 'People',
            'color' => '8e39a3',
        ]);

        ResourceType::create([
            'name' => 'Strategy & Planning Team',
            'category' => 'People',
            'color' => '8e39a3',
        ]);
    }
}
