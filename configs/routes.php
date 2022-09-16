<?php
use NalikCo\NalikNet\App\Router;
use NalikCo\NalikNet\Services\Feed\FeedService;

Router::get('/', FeedService::class);
Router::get('/login', FeedService::class);
