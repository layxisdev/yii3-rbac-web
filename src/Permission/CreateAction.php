<?php

declare(strict_types=1);

namespace Layxis\Yii\Rbac\Web\Permission;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Yiisoft\Http\Status;
use Yiisoft\Rbac\ManagerInterface;
use Yiisoft\Rbac\Permission;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Yii\View\Renderer\ViewRenderer;
use Layxis\Yii\Rbac\Web\Permission\PermissionForm;
use Psr\Http\Message\ResponseFactoryInterface;
use Yiisoft\FormModel\FormHydrator;

final class CreateAction
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

    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        $form = new PermissionForm();
        $this->formHydrator->populateFromPostAndValidate($form, $request);
        if ($form->isValid()) {
            $permission = (new Permission($form->getName()))
                ->withDescription($form->getDescription())
                ->withRuleName($form->getRuleName());

            $this->manager->addPermission($permission);

            return $this->responseFactory
                ->createResponse(Status::FOUND)
                ->withHeader('Location', $this->urlGenerator->generate('permission/index'));
        }

        return $this->viewRenderer->render('create', ['form' => $form]);
    }
}
