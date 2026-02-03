<?php

namespace Layxis\Yii\Rbac\Rule;

interface RuleCollectionProviderInterface
{
    public function getRules(): ?array;
}