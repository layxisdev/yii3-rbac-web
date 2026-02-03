<?php

namespace Layxis\Yii\Rbac\Web\Rule;

interface RuleCollectionProviderInterface
{
    public function getRules(): ?array;
}