<?php

declare(strict_types=1);

namespace Layxis\Yii\Rbac\Web\Permission;

use Layxis\Yii\Rbac\Web\Item\ItemForm;
use Yiisoft\Rbac\Item;

final class PermissionForm extends ItemForm
{
    public function __construct()
    {
        $this->setType(Item::TYPE_PERMISSION);
    }
}
