<?php

declare(strict_types=1);

namespace Layxis\Yii\Rbac\Web\Role;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Yiisoft\Form\FormHydrator;
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

        if ($request->getMethod() === 'POST' && $this->formHydrator->populate($form, $request->getParsedBody())) {
            $this->validator->validate($form);
            if ($form->isValid()) {
                $role = (new Role($form->getName()))
                    ->withDescription($form->getDescription())
                    ->withRuleName($form->getRuleName());

                $this->manager->add($role);

                return $this->responseFactory
                    ->createResponse(Status::FOUND)
                    ->withHeader('Location', $this->urlGenerator->generate('role/index'));
            }
        }

        return $this->viewRenderer->render('create', ['form' => $form]);
    }
}
