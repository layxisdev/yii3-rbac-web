<?php

declare(strict_types=1);

namespace Layxis\Yii\Rbac\Web\Role;

use Layxis\Yii\Rbac\Web\Item\ItemForm;
use Yiisoft\Rbac\Item;

final class RoleForm extends ItemForm
{
    public function __construct()
    {
        $this->setType(Item::TYPE_ROLE);
    }
}
