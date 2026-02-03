<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Layxis\Yii\Rbac\Web\Role\RoleForm;
use Yiisoft\Rbac\Item;

final class RoleFormTest extends TestCase
{
    public function testRoleFormHasTypeRole(): void
    {
        $form = new RoleForm();
        $this->assertSame(Item::TYPE_ROLE, $form->getType());
    }
}
