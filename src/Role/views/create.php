<?php

declare(strict_types=1);

use Layxis\Yii\Rbac\Web\Role\RoleForm;
use Yiisoft\FormModel\Field;
use Yiisoft\Html\Html;

/**
 * @var RoleForm $form
 * @var \Yiisoft\Router\UrlGeneratorInterface $urlGenerator
 * @var string $csrf
 */

$this->setTitle('Create Role');
?>

<h1>Create Role</h1>

<?=
$htmlForm = Html::form()
    ->post($urlGenerator->generate('role/create'))
    ->csrf($csrf);
?>

<?= $htmlForm->open() ?>

<?= Field::text($form, 'name') ?>
<?= Field::textarea($form, 'description') ?>
<?= Field::select($form, 'ruleName') ?>

<?= Html::submitButton('Create', ['class' => 'btn btn-primary']) ?>

<?= $htmlForm->close() ?>
