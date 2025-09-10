<?php

require_once 'vendor/autoload.php';

use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Illuminate\Database\Capsule\Manager as Capsule;

// Create a new container and set it as the global instance
$container = new Container();
Container::setInstance($container);

// Create a new event dispatcher and set it as the global instance
$events = new Dispatcher($container);
$capsule = new Capsule($container);
$capsule->setEventDispatcher($events);

// Add the database connection
$capsule->addConnection([
    'driver' => 'sqlite',
    'database' => __DIR__ . '/database/database.sqlite',
    'prefix' => '',
]);

// Make this Capsule instance available globally via static methods
$capsule->setAsGlobal();

// Setup the Eloquent ORM
$capsule->bootEloquent();

// Load the Page model
require_once 'app/Models/Page.php';

// Test the icon attribute
$pages = \App\Models\Page::published()->root()->get();

echo "Testing Page Icons:\n";
foreach ($pages as $page) {
    echo "Page: " . $page->title . " (slug: " . $page->slug . ") - Icon: " . $page->icon . "\n";
}