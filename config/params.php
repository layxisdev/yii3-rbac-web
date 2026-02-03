<?php
use Yiisoft\Definitions\Reference;
use Yiisoft\Yii\View\Renderer\CsrfViewInjection;

return [
    'yiisoft/yii-view-renderer' => [
        'injections' => [
            Reference::to(CsrfViewInjection::class),
        ],
    ],
];
