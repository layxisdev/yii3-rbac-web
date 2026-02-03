<?php

declare(strict_types=1);

use Yiisoft\Html\Html;
use Yiisoft\Rbac\Assignment;
use Yiisoft\Router\UrlGeneratorInterface;

/**
 * @var Assignment[] $assignments
 * @var UrlGeneratorInterface $urlGenerator
 * @var string $csrf
 */

$this->setTitle('Assignments');
?>

<h1>Assignments</h1>

<div class="mb-3">
    <a href="<?= $urlGenerator->generate('assignment/assign') ?>" class="btn btn-primary">Assign Role/Permission</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>User ID</th>
            <th>Item Name</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($assignments as $assignment): ?>
            <tr>
                <td><?= Html::encode($assignment->getUserId()) ?></td>
                <td><?= Html::encode($assignment->getItemName()) ?></td>
                <td>
                    <form action="<?= $urlGenerator->generate('assignment/revoke', ['userId' => $assignment->getUserId(), 'itemName' => $assignment->getItemName()]) ?>" method="post" style="display: inline-block;">
                        <input type="hidden" name="_csrf" value="<?= $csrf ?>">
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
