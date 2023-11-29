<?php

namespace VulcanPhp\Core\Console;

return [
    [
        'command' => ['serve', '-s'],
        'info'  => 'Start PHP Developement CLI and serve the application',
        'callback' => [Callback::class, 'serve']
    ],
    [
        'command' => ['help', '-h'],
        'info'  => 'Get help with artisan CLI command',
        'callback' => [Callback::class, 'help']
    ],
    [
        'command' => 'vite',
        'action' => 'init',
        'info'  => 'Initialize Vite+Vue Application Startup Setup',
        'callback' => [Vite::class, 'generate']
    ],
    [
        'command' => 'make',
        'action' => ['table', 'migration', 'schema', '-t'],
        'alias'  => '-t',
        'info'  => 'Create a New Database Table Schema Builder With Blueprint',
        'callback' => [Callback::class, 'table']
    ],
    [
        'command' => 'make',
        'action' => ['seeder', 'seed', '-s'],
        'alias'  => '-s',
        'info'  => 'Create a new seeder file for database inserting dummy data',
        'callback' => [Callback::class, 'seeder']
    ],
    [
        'command' => 'make',
        'action' => ['controller', 'control', '-c'],
        'alias' => '-c',
        'info'  => 'Create a Controller Class for public or admin functionality',
        'callback' => [Callback::class, 'controller']
    ],
    [
        'command' => 'make',
        'action' => ['model', '-m'],
        'alias' => '-m',
        'info'  => 'Database Modeling functionality with Query Builder and ORM',
        'callback' => [Callback::class, 'model']
    ],
    [
        'command' => 'make',
        'action' => ['middleware', 'guard', '-g'],
        'alias' => '-g',
        'info'  => 'Http Middleware or Guard which filter requests to access certain functionalities',
        'callback' => [Callback::class, 'middleware']
    ],
    [
        'command' => 'make',
        'action' => ['kernel', 'provider', '-k'],
        'alias' => '-k',
        'info'  => 'Application Kernel which setup all the required functionalities before boot',
        'callback' => [Callback::class, 'kernel']
    ],
    [
        'command' => 'make',
        'action' => ['resource', '-rs'],
        'alias' => '-rs',
        'info'  => 'Create Application Resource Pack (Model, View and Controller)',
        'callback' => [Callback::class, 'resource']
    ],
    [
        'command' => 'make',
        'action' => ['view', 'vw', '-v'],
        'alias' => '-v',
        'info'  => 'Create a new Application View file',
        'callback' => [Callback::class, 'view']
    ],
    [
        'command' => 'make',
        'action' => ['mail', '-ml'],
        'alias' => '-ml',
        'info'  => 'Create a Mail Template to send Emails from Application',
        'callback' => [Callback::class, 'mail']
    ],
    [
        'command' => 'migration',
        'action' => ['migrate', 'refresh', 'm', 'mg'],
        'info'  => 'Migrate all the existing database schema to create table into database',
        'callback' => [Callback::class, 'migrate']
    ],
    [
        'command' => 'migration',
        'action' => ['rollback', 'back', 'r', 'rb'],
        'info'  => 'Rollback Last Migrated Database Schema and Run Drop command',
        'callback' => [Callback::class, 'rollback']
    ],
    [
        'command' => 'migration',
        'action' => ['seeder', 'seed', 's', 'sd'],
        'info'  => 'Seed all the existing seeder files to create dummy data into database',
        'callback' => [Callback::class, 'seed']
    ],
];
