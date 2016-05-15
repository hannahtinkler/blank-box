<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'remember_token' => str_random(10)
    ];
});

$factory->define(App\Models\Category::class, function (Faker\Generator $faker) {
    $title = $faker->sentence;
    return [
        'title' => $title,
        'description' => $faker->sentence,
        'slug' => str_slug($title),
        'order' => $faker->randomDigit
    ];
});

$factory->define(App\Models\Chapter::class, function (Faker\Generator $faker) {
    $title = $faker->sentence;
    return [
        'category_id' => factory(App\Models\Category::class)->create()->id,
        'title' => $title,
        'description' => $faker->sentence,
        'order' => $faker->randomDigit,
        'slug' => str_slug($title)
    ];
});

$factory->define(App\Models\Page::class, function (Faker\Generator $faker) {
    $title = $faker->sentence;
    return [
        'chapter_id' => factory(App\Models\Chapter::class)->create()->id,
        'title' => $title,
        'description' => $faker->sentence,
        'content' => $faker->text,
        'slug' => str_slug($title),
        'order' => $faker->randomDigit,
        'created_by' => factory(App\Models\User::class)->create()->id
    ];
});

$factory->define(App\Models\PageDraft::class, function (Faker\Generator $faker) {
    $title = $faker->sentence;
    return [
        'chapter_id' => factory(App\Models\Chapter::class)->create()->id,
        'title' => $title,
        'description' => $faker->sentence,
        'content' => $faker->text,
        'created_by' => factory(App\Models\User::class)->create()->id
    ];
});

$factory->define(App\Models\Bookmark::class, function (Faker\Generator $faker) {
    $page = factory(App\Models\Page::class)->create();
    return [
        'user_id' => $page->created_by,
        'category_id' => $page->chapter->category->id,
        'chapter_id' => $page->chapter->id,
        'page_id' => $page->id
    ];
});

$factory->define(App\Models\Server::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'nickname' => $faker->word,
        'location' => $faker->state,
        'ip_address' => $faker->ipv4,
        'node_type' => $faker->word,
        'access_type' => $faker->word
    ];
});

$factory->define(App\Models\Service::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'area' => $faker->state,
        'type' => $faker->word,
        'server_id' => factory(App\Models\Server::class)->create()->id,
        'live_site_url' => $faker->url
    ];
});

$factory->define(App\Models\ServerPortForwardingSetting::class, function (Faker\Generator $faker) {
    return [
        'server_id' => factory(App\Models\Server::class)->create()->id,
        'source_port_number' => $faker->randomDigit,
        'target_port_number' => $faker->randomDigit
    ];
});

$factory->define(App\Models\Suggestion::class, function (Faker\Generator $faker) {
    return [
        'page_id' => factory(App\Models\Page::class)->create()->id,
        'suggestion' => $faker->text,
        'approved' => $faker->boolean,
        'created_by' => factory(App\Models\User::class)->create()->id,
    ];
});
