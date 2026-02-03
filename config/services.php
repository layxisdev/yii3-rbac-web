<?php

declare(strict_types=1);

use Layxis\Yii\Rbac\Rule\RuleCollectionProvider;
use Layxis\Yii\Rbac\Web\Rule\RuleCollectionProviderInterface;
use Yiisoft\Definitions\Reference;

return [
    // Register the rule provider so Actions can inject it and pass rules to views
    RuleCollectionProviderInterface::class => Reference::to(RuleCollectionProvider::class),
];
