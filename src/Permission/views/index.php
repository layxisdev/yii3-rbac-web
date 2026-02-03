<?php

declare(strict_types=1);

use Yiisoft\Html\Html;
use Yiisoft\Rbac\Permission;
use Yiisoft\Router\UrlGeneratorInterface;

/**
 * @var Permission[] $permissions
 * @var UrlGeneratorInterface $urlGenerator
 * @var string $csrf
 */

$this->setTitle('Permissions');
?>

<h1>Permissions</h1>

<div class="mb-3">
    <a href="<?= $urlGenerator->generate('permission/create') ?>" class="btn btn-primary">Create Permission</a>
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
        <?php foreach ($permissions as $permission): ?>
            <tr>
                <td><?= Html::encode($permission->getName()) ?></td>
                <td><?= Html::encode($permission->getDescription()) ?></td>
                <td>
                    <a href="<?= $urlGenerator->generate('permission/view', ['name' => $permission->getName()]) ?>" class="btn btn-sm btn-info">View</a>
                    <a href="<?= $urlGenerator->generate('permission/update', ['name' => $permission->getName()]) ?>" class="btn btn-sm btn-primary">Update</a>
                    <form action="<?= $urlGenerator->generate('permission/delete', ['name' => $permission->getName()]) ?>" method="post" style="display: inline-block;">
                        <input type="hidden" name="_csrf" value="<?= $csrf ?>">
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
