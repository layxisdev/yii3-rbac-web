<?php

declare(strict_types=1);

use Yiisoft\Html\Html;
use Yiisoft\Rbac\Permission;

/**
 * @var Permission $permission
 */

$this->setTitle('Permission: ' . $permission->getName());
?>

<h1>Permission: <?= Html::encode($permission->getName()) ?></h1>

<ul class="list-group">
    <li class="list-group-item">
        <strong>Name:</strong> <?= Html::encode($permission->getName()) ?>
    </li>
    <li class="list-group-item">
        <strong>Description:</strong> <?= Html::encode($permission->getDescription()) ?>
    </li>
    <li class="list-group-item">
        <strong>Rule Name:</strong> <?= $permission->getRuleName() ? Html::encode($permission->getRuleName()) : '(not set)' ?>
    </li>
    <li class="list-group-item">
        <strong>Created At:</strong> <?= date('Y-m-d H:i:s', $permission->getCreatedAt()) ?>
    </li>
    <li class="list-group-item">
        <strong>Updated At:</strong> <?= date('Y-m-d H:i:s', $permission->getUpdatedAt()) ?>
    </li>
</ul>
