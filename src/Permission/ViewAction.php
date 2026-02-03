<?php

declare(strict_types=1);

namespace Layxis\Yii\Rbac\Web\Permission;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Yiisoft\Http\Status;
use Yiisoft\Rbac\ManagerInterface;
use Yiisoft\Yii\View\Renderer\ViewRenderer;
use Psr\Http\Message\ResponseFactoryInterface;
use Yiisoft\Router\HydratorAttribute\RouteArgument;

final class ViewAction
{
    public function __construct(
        private ViewRenderer $viewRenderer,
        private ManagerInterface $manager,
        private ResponseFactoryInterface $responseFactory,
    ) {
        $this->viewRenderer = $viewRenderer->withControllerName('permission');
    }

    public function __invoke(ServerRequestInterface $request, #[RouteArgument('name')] string $name): ResponseInterface
    {
        $permission = $this->manager->getPermission($name);
        if($permission === null) {
            return $this->responseFactory
                ->createResponse(Status::NOT_FOUND, 'Permission not found');
        }
        return $this->viewRenderer->render('view', ['permission' => $permission]);
    }
}
