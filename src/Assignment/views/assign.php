<?php

declare(strict_types=1);

use Layxis\Yii\Rbac\Web\Permission\PermissionForm;
use Yiisoft\FormModel\Field;
use Yiisoft\Html\Html;

/**
 * @var PermissionForm $form
 * @var \Yiisoft\Router\UrlGeneratorInterface $urlGenerator
 * @var string $csrf
 */

$this->setTitle('Assign Role/Permission');
?>

<h1>Assign Role/Permission</h1>

<?= 
$htmlForm = Html::form()
    ->post($urlGenerator->generate('assignment/assign'))
    ->csrf($csrf);
?>

<?= $htmlForm->open() ?>

<?= Field::text($form, 'userId') ?>
<?= Field::select($form, 'itemName', $items) ?>

<?= Html::submitButton('Assign', ['class' => 'btn btn-primary']) ?>

<?= $htmlForm->close() ?>
