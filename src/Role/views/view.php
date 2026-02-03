<?php

declare(strict_types=1);

use Yiisoft\Html\Html;
use Yiisoft\Rbac\Role;

/**
 * @var Role $role
 */

$this->setTitle('Role: ' . $role->getName());
?>

<h1>Role: <?= Html::encode($role->getName()) ?></h1>

<ul class="list-group">
    <li class="list-group-item">
        <strong>Name:</strong> <?= Html::encode($role->getName()) ?>
    </li>
    <li class="list-group-item">
        <strong>Description:</strong> <?= Html::encode($role->getDescription()) ?>
    </li>
    <li class="list-group-item">
        <strong>Rule Name:</strong> <?= $role->getRuleName() ? Html::encode($role->getRuleName()) : '(not set)' ?>
    </li>
    <li class="list-group-item">
        <strong>Created At:</strong> <?= date('Y-m-d H:i:s', $role->getCreatedAt()) ?>
    </li>
    <li class="list-group-item">
        <strong>Updated At:</strong> <?= date('Y-m-d H:i:s', $role->getUpdatedAt()) ?>
    </li>
</ul>
