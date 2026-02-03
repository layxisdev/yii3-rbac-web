<?php

declare(strict_types=1);

use Layxis\Yii\Rbac\Web\Permission\PermissionForm;
use Yiisoft\FormModel\Field;
use Yiisoft\Html\Html;

/**
 * @var PermissionForm $form
 * @var \Yiisoft\Router\UrlGeneratorInterface $urlGenerator
 * @var \Yiisoft\Rbac\Permission $permission
 * @var string $csrf
 */

$this->setTitle('Update Permission');
?>

<h1>Update Permission "<?= Html::encode($permission->getName()) ?>"</h1>

<?= 
$htmlForm = Html::form()
    ->post($urlGenerator->generate('permission/update', ['name' => $permission->getName()]))
    ->csrf($csrf); ?>

<?= $htmlForm->open() ?>
<?= Field::text($form, 'name') ?>
<?= Field::textarea($form, 'description') ?>
<?= Field::select($form, 'ruleName') ?>

<?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>

<?= $htmlForm->close() ?>
