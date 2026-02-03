<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Layxis\Yii\Rbac\Web\Rule\RuleCollectionProvider;

final class RuleCollectionProviderTest extends TestCase
{
    public function testGetRulesReturnsArray(): void
    {
        $provider = new RuleCollectionProvider();
        $rules = $provider->getRules();
        $this->assertIsArray($rules);
        $this->assertArrayHasKey('isOwner', $rules);
        $this->assertArrayHasKey('', $rules);
        $this->assertSame('(none)', $rules['']);
        $this->assertGreaterThanOrEqual(3, count($rules));
    }
}
