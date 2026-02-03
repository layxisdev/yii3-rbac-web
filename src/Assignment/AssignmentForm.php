<?php

declare(strict_types=1);

namespace Layxis\Yii\Rbac\Web\Assignment;

use Yiisoft\FormModel\FormModel;
use Yiisoft\Rbac\Item;
use Yiisoft\Validator\Rule\In;
use Yiisoft\Validator\Rule\Length;
use Yiisoft\Validator\Rule\Regex;
use Yiisoft\Validator\Rule\Required;

class AssignmentForm extends FormModel
{
    #[Required]
    #[Regex('/^[a-zA-Z0-9_-\s]+$/')]
    #[Length(min: 1, max: 64)]
    private string $itemName = '';

    #[Required]
    private string $userId = '' ;    

    public function getItemName(): string
    {
        return $this->itemName  ;
    }

    public function setItemName(string $itemName): void
    {
        $this->itemName = $itemName;
    }

    public function getUserId(): string
    {
        return $this->userId ;
    }

    public function setUserId(string $userId): void
    {
        $this->userId = $userId;
    }
}