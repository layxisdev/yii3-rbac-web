<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Layxis\Yii\Rbac\Web\Item\ItemForm;

final class ItemFormAttributesTest extends TestCase
{
    public function testNameFieldAttributes(): void
    {
        $r = new ReflectionClass(ItemForm::class);
        $prop = $r->getProperty('name');
        $attrs = array_map(fn($a) => $a->getName(), $prop->getAttributes());

        $this->assertContains('Yiisoft\\Validator\\Rule\\Required', $attrs);
        $this->assertContains('Yiisoft\\Validator\\Rule\\Regex', $attrs);
        $this->assertContains('Yiisoft\\Validator\\Rule\\Length', $attrs);
    }

    public function testTypeFieldHasInRule(): void
    {
        $r = new ReflectionClass(ItemForm::class);
        $prop = $r->getProperty('type');
        $attrs = array_map(fn($a) => $a->getName(), $prop->getAttributes());

        $this->assertContains('Yiisoft\\Validator\\Rule\\In', $attrs);
    }
}
