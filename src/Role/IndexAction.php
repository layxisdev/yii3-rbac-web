<?php

declare(strict_types=1);

namespace Layxis\Yii\Rbac\Web\Role;

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
        $this->viewRenderer = $viewRenderer->withControllerName('role');
    }

    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        $roles = $this->itemsStorage->getRoles();

        return $this->viewRenderer->render('index', ['roles' => $roles]);
    }
}
