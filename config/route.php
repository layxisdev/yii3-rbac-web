<?php

declare(strict_types=1);

use Layxis\Yii\Rbac\Web\Permission\IndexAction as PermissionIndex;
use Layxis\Yii\Rbac\Web\Permission\CreateAction as PermissionCreate;
use Layxis\Yii\Rbac\Web\Permission\UpdateAction as PermissionUpdate;
use Layxis\Yii\Rbac\Web\Permission\DeleteAction as PermissionDelete;
use Layxis\Yii\Rbac\Web\Permission\ViewAction as PermissionView;
use Layxis\Yii\Rbac\Web\Role\IndexAction as RoleIndex;
use Layxis\Yii\Rbac\Web\Role\CreateAction as RoleCreate;
use Layxis\Yii\Rbac\Web\Role\UpdateAction as RoleUpdate;
use Layxis\Yii\Rbac\Web\Role\DeleteAction as RoleDelete;
use Layxis\Yii\Rbac\Web\Role\ViewAction as RoleView;
use Yiisoft\Router\Group;
use Yiisoft\Router\Route;


return [
    'routes' => [
        Group::create()
            ->namePrefix('role/')
            ->routes(
                Route::get('/roles')->action(RoleIndex::class)->name('index'),
                Route::get('/roles/{name}')->action(RoleIndex::class)->name('name'),
                Route::methods(['GET', 'POST'], '/role/create')->action(RoleCreate::class)->name('create'),
                Route::methods(['GET', 'POST'], '/role/update/{name}')->action(RoleUpdate::class)->name('update'),
                Route::post('/role/delete/{name}')->action(RoleDelete::class)->name('delete'),
                Route::get('/role/{name}')->action(RoleView::class)->name('view'),
            ),

        Group::create()
            ->namePrefix('permission/')
            ->routes(
                Route::get('/permissions')->action(PermissionIndex::class)->name('index'),
                Route::get('/permissions/{name}')->action(PermissionIndex::class)->name('name'),
                Route::methods(['GET', 'POST'], '/permission/create')->action(PermissionCreate::class)->name('create'),
                Route::methods(['GET', 'POST'], '/permission/update/{name}')->action(PermissionUpdate::class)->name('update'),
                Route::post('/permission/delete/{name}')->action(PermissionDelete::class)->name('delete'),
                Route::get('/permission/{name}')->action(PermissionView::class)->name('view'),
            ),
    ],
];