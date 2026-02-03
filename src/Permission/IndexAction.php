<?php

declare(strict_types=1);

namespace Layxis\Yii\Rbac\Web\Permission;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Yiisoft\Rbac\ItemsStorageInterface;
use Yiisoft\Yii\View\Renderer\ViewRenderer;

final class IndexAction
{
    public function __construct(
        private ItemsStorageInterface $itemsStorage,
        private ViewRenderer $viewRenderer,
    ) {
        $this->viewRenderer = $viewRenderer->withControllerName('permission');
    }

    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        $permission =  $this->itemsStorage->getPermissions();

        return $this->viewRenderer->render(
            view: 'index',
            parameters: [
                'permissions' => $permission,
            ],
        );
    }
}
