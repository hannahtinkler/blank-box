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
    $name = $faker->name;

    return [
        'name' => $name,
        'email' => $faker->safeEmail,
        'remember_token' => str_random(10),
        'slug' => str_slug($name)
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
        'approved' => null,
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
        'chapter_id' => $page->chapter_id,
        'page_id' => $page->id,
        'user_id' => $page->created_by
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

$factory->define(App\Models\SuggestedEdit::class, function (Faker\Generator $faker) {
    $title = $faker->sentence;
    return [
        'chapter_id' => factory(App\Models\Chapter::class)->create()->id,
        'page_id' => factory(App\Models\Page::class)->create()->id,
        'title' => $title,
        'description' => $faker->sentence,
        'content' => $faker->text,
        'approved' => null,
        'created_by' => factory(App\Models\User::class)->create()->id
    ];
});

$factory->define(App\Models\SlugForwardingSetting::class, function (Faker\Generator $faker) {
    $old = factory(App\Models\Page::class)->create();
    $new = factory(App\Models\Page::class)->create();

    return [
        'old_slug' => $old->slug,
        'new_slug' => $new->slug
    ];
});

$factory->define(App\Models\BadgeType::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->sentence(3),
        'metric' => 'pagesSubmittedInChapter',
        'description' => $faker->sentence
    ];
});

$factory->define(App\Models\BadgeGroup::class, function (Faker\Generator $faker) {
    $badgeType = factory(App\Models\BadgeType::class)->create();
    $chapter = factory(App\Models\Chapter::class)->create();
    
    return [
        'badge_type_id' => $badgeType->id,
        'name' => $faker->sentence(3),
        'description' => $faker->sentence,
        'metric_entity' => $chapter->id
    ];
});

$factory->define(App\Models\Badge::class, function (Faker\Generator $faker) {
    $badgeGroup = factory(App\Models\BadgeGroup::class)->create();
    $user = factory(App\Models\User::class)->create();
    
    return [
        'badge_group_id' => $badgeGroup->id,
        'name' => $faker->sentence(3),
        'description' => $faker->sentence,
        'level' => $faker->numberBetween(1, 5),
        'metric_boundary' => $faker->randomNumber(2),
    ];
});

$factory->define(App\Models\UserBadge::class, function (Faker\Generator $faker) {
    $badge = factory(App\Models\Badge::class)->create();
    $user = factory(App\Models\User::class)->create();
    
    return [
        'badge_id' => $badge->id,
        'user_id' => $user->id,
        'read' => $faker->boolean,
        'default' => $faker->boolean
    ];
});

$factory->define(App\Models\Tag::class, function (Faker\Generator $faker) {
    return [
        'tag' => $faker->word
    ];
});

$factory->define(App\Models\PageTag::class, function (Faker\Generator $faker) {
    $page = factory(App\Models\Page::class)->create();
    $tag = factory(App\Models\Tag::class)->create();

    return [
        'page_id' => $page->id,
        'tag_id' => $tag->id
    ];
});

$factory->define(App\Models\FeedEventType::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
        'text' => $faker->sentence
    ];
});

$factory->define(App\Models\FeedEvent::class, function (Faker\Generator $faker) {
    $user = factory(App\Models\User::class)->create();
    $type = factory(App\Models\FeedEventType::class)->create();
    $page = factory(App\Models\Page::class)->create();
    
    return [
        'feed_event_type_id' => $type->id,
        'user_id' => $user->id,
        'resource_id' => $page->id
    ];
});

$factory->define(App\Models\Contributor::class, function (Faker\Generator $faker) {
    $user = factory(App\Models\User::class)->create();
    
    return [
        'user_id' => $user->id,
        'count' => $faker->randomNumber(1)
    ];
});
