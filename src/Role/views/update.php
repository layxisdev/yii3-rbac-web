<?php

declare(strict_types=1);

use Layxis\Yii\Rbac\Web\Role\RoleForm;
use Yiisoft\FormModel\Field;
use Yiisoft\Html\Html;
use Yiisoft\Rbac\Role;

/**
 * @var RoleForm $form
 * @var Role $role
 * @var \Yiisoft\Router\UrlGeneratorInterface $urlGenerator
 * @var string $csrf
 */

$this->setTitle('Update Role');
?>

<h1>Update Role "<?= Html::encode($role->getName()) ?>"</h1>

<?=
$htmlForm = Html::form()
    ->post($urlGenerator->generate('role/update', ['name' => $role->getName()]))
    ->csrf($csrf);
?>

<?= $htmlForm->open() ?>
<?= Field::text($form, 'name') ?>
<?= Field::textarea($form, 'description') ?>
<?= empty($ruleCollectionProvider) ? Field::text($form, 'ruleName') : Field::select($form, 'ruleName', $ruleCollectionProvider->getRules()) ?>

<?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>

<?= $htmlForm->close() ?>
