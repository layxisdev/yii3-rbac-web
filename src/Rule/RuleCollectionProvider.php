<?php

declare(strict_types=1);

namespace Layxis\Yii\Rbac\Web\Rule;

final class RuleCollectionProvider implements RuleCollectionProviderInterface
{
    /**
     * Return an associative array of ruleName => label for select options.
     * Example: ['isOwner' => 'Is owner', 'timeBased' => 'Time based']
     */
    public function getRules(): ?array
    {
        // Provide a simple default list. Replace or extend in your app.
        return [
            '' => '(none)',
            'isOwner' => 'Is owner',
            'timeBased' => 'Time based',
        ];
    }
}
