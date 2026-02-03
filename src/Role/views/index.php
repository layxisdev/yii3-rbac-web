<?php

declare(strict_types=1);

use Yiisoft\Html\Html;
use Yiisoft\Rbac\Role;
use Yiisoft\Router\UrlGeneratorInterface;

/**
 * @var Role[] $roles
 * @var UrlGeneratorInterface $urlGenerator
 * @var string $csrf
 */

$this->setTitle('Roles');
?>

<h1>Roles</h1>

<div class="mb-3">
    <a href="<?= $urlGenerator->generate('role/create') ?>" class="btn btn-primary">Create Role</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($roles as $role): ?>
            <tr>
                <td><?= Html::encode($role->getName()) ?></td>
                <td><?= Html::encode($role->getDescription()) ?></td>
                <td>
                    <a href="<?= $urlGenerator->generate('role/view', ['name' => $role->getName()]) ?>" class="btn btn-sm btn-info">View</a>
                    <a href="<?= $urlGenerator->generate('role/update', ['name' => $role->getName()]) ?>" class="btn btn-sm btn-primary">Update</a>
                    <form action="<?= $urlGenerator->generate('role/delete', ['name' => $role->getName()]) ?>" method="post" style="display: inline-block;">
                        <input type="hidden" name="_csrf" value="<?= $csrf ?>">
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
