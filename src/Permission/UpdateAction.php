<?php

declare(strict_types=1);

namespace Layxis\Yii\Rbac\Web\Permission;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Yiisoft\Http\Status;
use Yiisoft\Rbac\ManagerInterface;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Yii\View\Renderer\ViewRenderer;
use Layxis\Yii\Rbac\Web\Permission\PermissionForm;
use Psr\Http\Message\ResponseFactoryInterface;
use Yiisoft\FormModel\FormHydrator;
use Yiisoft\Router\HydratorAttribute\RouteArgument;

final class UpdateAction
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

    public function __invoke(ServerRequestInterface $request, #[RouteArgument('name')] string $name): ResponseInterface
    {
        $permission = $this->manager->getPermission($name);
        if ($permission === null) {
            return $this->responseFactory->createResponse(Status::NOT_FOUND);
        }
        $form = new PermissionForm();
        if ($this->formHydrator->populateFromPostAndValidate($form, $request)) {    
            $permission = $permission->withName($form->getName())
                ->withDescription($form->getDescription())
                ->withRuleName($form->getRuleName());

            $this->manager->updatePermission($name, $permission);

            return $this->responseFactory
                ->createResponse(Status::FOUND)
                ->withHeader('Location', $this->urlGenerator->generate('permission/index'));
        }
        $form->setName($permission->getName());
        $form->setDescription($permission->getDescription());
        $form->setRuleName($permission->getRuleName());

        return $this->viewRenderer->render('update', ['form' => $form]);
    }
}
