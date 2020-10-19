<?php

declare(strict_types=1);

/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

use Hyperf\HttpServer\Router\Router;

Router::addRoute(['GET', 'POST', 'HEAD'], '/', 'App\Controller\IndexController@index');

Router::get('/favicon.ico', function () {
    return '';
});

// 先整一下文章的增删改查
// 路由组的定义
Router::get('/articles', [\App\Controller\ArticleController::class, 'index']);
Router::get('/article/{id}', [\App\Controller\ArticleController::class, 'info']);
Router::post('/article/add', [\App\Controller\ArticleController::class, 'add']);
Router::post('/article/update', [\App\Controller\ArticleController::class, 'update']);
Router::post('/article/delete', [\App\Controller\ArticleController::class, 'delete']);
Router::post('/article/add-tags', [\App\Controller\ArticleController::class, 'addTags']);
Router::post('/article/delete-tags', [\App\Controller\ArticleController::class, 'deleteTags']);

// 分类的增删改查
Router::get('/categories', [\App\Controller\CategoryController::class, 'index']);
Router::get('/category/{id}', [\App\Controller\CategoryController::class, 'info']);
Router::post('/category/add', [\App\Controller\CategoryController::class, 'add']);
Router::post('/category/update', [\App\Controller\CategoryController::class, 'update']);
Router::post('/category/delete', [\App\Controller\CategoryController::class, 'delete']);

// 标签的增删改查
Router::get('/tags', [\App\Controller\TagController::class, 'index']);
Router::get('/tag/{id}', [\App\Controller\TagController::class, 'info']);
Router::post('/tag/add', [\App\Controller\TagController::class, 'add']);
Router::post('/tag/update', [\App\Controller\TagController::class, 'update']);
Router::post('/tag/delete', [\App\Controller\TagController::class, 'delete']);

// 下面开始定义路由
Router::post('user/logout', [\App\Controller\UserController::class, 'logout']);
Router::post('user/login', [\App\Controller\UserController::class, 'login']);
