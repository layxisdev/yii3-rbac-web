<?php

declare(strict_types=1);

namespace Layxis\Yii\Rbac\Web\Item;

use Yiisoft\FormModel\FormModel;
use Yiisoft\Rbac\Item;
use Yiisoft\Validator\Rule\In;
use Yiisoft\Validator\Rule\Length;
use Yiisoft\Validator\Rule\Regex;
use Yiisoft\Validator\Rule\Required;

class ItemForm extends FormModel
{
    #[Required]
    #[Regex('/^[a-zA-Z0-9_-\s]+$/')]
    #[Length(min: 1, max: 64)]
    private string $name = '';

    #[Length(max: 255)]
    private string $description = '';

    #[Length(max: 64)]
    private ?string $ruleName = null;

    #[In([Item::TYPE_PERMISSION, Item::TYPE_ROLE])]
    private ?string $type = null;

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getRuleName(): ?string
    {
        return $this->ruleName;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function setRuleName(?string $ruleName): void
    {
        $this->ruleName = $ruleName;
    }

    public function setType(?string $type): void
    {
        $this->type = $type;
    }

    public function getType(): ?string
    {
        return $this->type;
    }
}