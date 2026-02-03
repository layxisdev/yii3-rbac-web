<?php

declare(strict_types=1);

namespace Layxis\Yii\Rbac\Web\Role;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Yiisoft\Http\Status;
use Yiisoft\Rbac\ManagerInterface;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Yii\View\Renderer\ViewRenderer;
use Psr\Http\Message\ResponseFactoryInterface;
use Yiisoft\FormModel\FormHydrator;
use Yiisoft\Router\HydratorAttribute\RouteArgument;
use Yiisoft\Validator\ValidatorInterface;

final class UpdateAction
{
    public function __construct(
        private ViewRenderer $viewRenderer,
        private ManagerInterface $manager,
        private UrlGeneratorInterface $urlGenerator,
        private FormHydrator $formHydrator,
        private ResponseFactoryInterface $responseFactory,
        private ValidatorInterface $validator
    ) {
        $this->viewRenderer = $viewRenderer->withControllerName('role');
    }

    public function __invoke(ServerRequestInterface $request, #[RouteArgument('name')] string $name): ResponseInterface
    {
        $role = $this->manager->getRole($name);
        if ($role === null) {
            return $this->responseFactory->createResponse(Status::NOT_FOUND);
        }

        $form = new RoleForm();
        
        if ($this->formHydrator->populateFromPostAndValidate($form, $request)) {
                $newRole = $role
                    ->withName($form->getName())
                    ->withDescription($form->getDescription())
                    ->withRuleName($form->getRuleName());

                $this->manager->updateRole($name, $newRole);

                return $this->responseFactory
                    ->createResponse(Status::FOUND)
                    ->withHeader('Location', $this->urlGenerator->generate('role/index'));
        }

        $form->setName($role->getName());
        $form->setDescription($role->getDescription());
        $form->setRuleName($role->getRuleName());

        return $this->viewRenderer->render('update', ['form' => $form, 'role' => $role]);
    }
}
