<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Layxis\Yii\Rbac\Web\Permission\PermissionForm;

final class PermissionFormBehaviorTest extends TestCase
{
    public function testSettersAndGetters(): void
    {
        $form = new PermissionForm();
        $form->setName('create_post');
        $form->setDescription('Allows creating posts');
        $form->setRuleName('isOwner');

        $this->assertSame('create_post', $form->getName());
        $this->assertSame('Allows creating posts', $form->getDescription());
        $this->assertSame('isOwner', $form->getRuleName());
    }
}
