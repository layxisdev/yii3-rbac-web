<?php

declare(strict_types=1);

namespace Layxis\Yii\Rbac\Web\Permission;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Yiisoft\Rbac\ItemsStorageInterface;
use Yiisoft\Router\HydratorAttribute\RouteArgument;
use Yiisoft\Yii\View\Renderer\ViewRenderer;

final class IndexAction
{
    public function __construct(
        private ItemsStorageInterface $itemsStorage,
        private ViewRenderer $viewRenderer,
    ) {
    }

    public function __invoke(ServerRequestInterface $request, #[RouteArgument('name')] ?string $name = null): ResponseInterface
    {
        $permission = $name !== null ? $this->itemsStorage->getPermissionsByNames((array)$name) : $this->itemsStorage->getPermissions();
        $this->viewRenderer->withViewPath('./views');
        return $this->viewRenderer->render(
            view: 'permission/index',
            parameters: [
                'permissions' => $permission,
            ],
        );
    }
}