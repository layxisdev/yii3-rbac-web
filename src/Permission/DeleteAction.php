<?php

declare(strict_types=1);

namespace Layxis\Yii\Rbac\Web\Permission;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Yiisoft\Http\Status;
use Yiisoft\Rbac\ManagerInterface;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Yii\View\Renderer\ViewRenderer;
use Layxis\Yii\Rbac\Web\Permission\PermissionForm;
use Psr\Http\Message\ResponseFactoryInterface;
use Yiisoft\FormModel\FormHydrator;

final class DeleteAction implements RequestHandlerInterface
{
    public function __construct(
        private ViewRenderer $viewRenderer,
        private ManagerInterface $manager,
        private UrlGeneratorInterface $urlGenerator,
        private FormHydrator $formHydrator,
        private ResponseFactoryInterface $responseFactory,
    ) {
        $this->viewRenderer = $viewRenderer->withControllerName('permission');
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $form = new PermissionForm();
        $this->formHydrator->populateFromPostAndValidate($form, $request);
        $this->manager->removePermission($form->getName());
        return $this->responseFactory
            ->createResponse(Status::FOUND)
            ->withHeader('Location', $this->urlGenerator->generate('permission/index'));
     
    }
}
