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

$this->setTitle('Create Permission');
?>

<h1>Create Permission</h1>

<?= 
$htmlForm = Html::form()
    ->post($urlGenerator->generate('permission/create'))
    ->csrf($csrf);
?>

<?= $htmlForm->open() ?>

<?= Field::text($form, 'name') ?>
<?= Field::textarea($form, 'description') ?>
<?= empty($ruleCollectionProvider) ? Field::text($form, 'ruleName') : Field::select($form, 'ruleName', $ruleCollectionProvider->getRules()) ?>

<?= Html::submitButton('Create', ['class' => 'btn btn-primary']) ?>

<?= $htmlForm->close() ?>
