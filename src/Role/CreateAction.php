<?php

declare(strict_types=1);

namespace Layxis\Yii\Rbac\Web\Role;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Yiisoft\FormModel\FormHydrator;
use Yiisoft\Http\Status;
use Yiisoft\Rbac\ManagerInterface;
use Yiisoft\Rbac\Role;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Yii\View\Renderer\ViewRenderer;
use Psr\Http\Message\ResponseFactoryInterface;
use Yiisoft\Validator\ValidatorInterface;

final class CreateAction
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

    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        $form = new RoleForm();
        
        if ($this->formHydrator->populateFromPostAndValidate($form, $request)) {
            $role = (new Role($form->getName()))
                ->withDescription($form->getDescription())
                ->withRuleName($form->getRuleName());

            $this->manager->addRole($role);

            return $this->responseFactory
                ->createResponse(Status::FOUND)
                ->withHeader('Location', $this->urlGenerator->generate('role/index'));
        }

        return $this->viewRenderer->render('create', ['form' => $form]);
    }
}
