<?php

declare(strict_types=1);

namespace Layxis\Yii\Rbac\Web\Assignment;

use Layxis\Yii\Rbac\Web\Assignment\AssignmentForm;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Yiisoft\Http\Status;
use Yiisoft\Rbac\ManagerInterface;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Yii\View\Renderer\ViewRenderer;
use Psr\Http\Message\ResponseFactoryInterface;
use Yiisoft\FormModel\FormHydrator;

final class RevokeAction
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
        $form = new AssignmentForm();

        $this->formHydrator->populateFromPostAndValidate($form, $request);

        $this->manager->revoke($form->getItemName(), $form->getUserId());

        return $this->responseFactory
            ->createResponse(Status::FOUND)
            ->withHeader('Location', $this->urlGenerator->generate('permission/index', ['userId' => $form->getUserId()]));
     
    }
}
