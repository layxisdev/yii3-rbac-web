<?php

declare(strict_types=1);

namespace Layxis\Yii\Rbac\Web\Assignment;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Yiisoft\Rbac\AssignmentsStorageInterface;
use Yiisoft\Router\HydratorAttribute\RouteArgument;
use Yiisoft\Yii\View\Renderer\ViewRenderer;

final class IndexAction
{
    public function __construct(
        private AssignmentsStorageInterface $assignmentStorage,
        private ViewRenderer $viewRenderer,
    ) {
        $this->viewRenderer = $viewRenderer->withControllerName('assignment');
    }

    public function __invoke(ServerRequestInterface $request, #[RouteArgument('userId')] ?string $userId = null): ResponseInterface
    {
        $assignments = $userId == null ? $this->assignmentStorage->getAll() : $this->assignmentStorage->getByUserId($userId);
        $this->viewRenderer = $this->viewRenderer->withViewPath('./views');

        return $this->viewRenderer->render(
            view: 'assignment/index',
            parameters: [
                'assignments' => $assignments,
            ],
        );
    }
}
