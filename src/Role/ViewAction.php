<?php

declare(strict_types=1);

namespace Layxis\Yii\Rbac\Web\Role;

use Psr\Http\Message\ResponseInterface;
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
        private ResponseFactoryInterface $responseFactory
    ) {
        $this->viewRenderer = $viewRenderer->withControllerName('role');
    }

    public function __invoke(#[RouteArgument('name')] string $name): ResponseInterface
    {
        $role = $this->manager->getRole($name);
        if ($role === null) {
            return $this->responseFactory->createResponse(Status::NOT_FOUND);
        }
        return $this->viewRenderer->render('view', ['role' => $role]);
    }
}
