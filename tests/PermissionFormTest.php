<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Layxis\Yii\Rbac\Web\Permission\PermissionForm;
use Yiisoft\Rbac\Item;

final class PermissionFormTest extends TestCase
{
    public function testPermissionFormHasTypePermission(): void
    {
        $form = new PermissionForm();
        $this->assertSame(Item::TYPE_PERMISSION, $form->getType());
    }
}
