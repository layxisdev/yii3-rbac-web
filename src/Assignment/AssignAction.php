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
use Yiisoft\Arrays\ArrayHelper;
use Yiisoft\FormModel\FormHydrator;
use Yiisoft\Rbac\ItemsStorageInterface;

final class AssignAction
{
    public function __construct(
        private ViewRenderer $viewRenderer,
        private ManagerInterface $manager,
        private ItemsStorageInterface $itemsStorage,
        private UrlGeneratorInterface $urlGenerator,
        private FormHydrator $formHydrator,
        private ResponseFactoryInterface $responseFactory,
    ) {
        $this->viewRenderer = $viewRenderer->withControllerName('assignment');
    }

    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        $form = new AssignmentForm();
        $this->formHydrator->populateFromPostAndValidate($form, $request);
        if ($form->isValid()) {

            $this->manager->assign($form->getItemName(), $form->getUserId());

            return $this->responseFactory
                ->createResponse(Status::FOUND)
                ->withHeader('Location', $this->urlGenerator->generate('assignment/index', ['userId' => $form->getUserId()]));
        }
        
        return $this->viewRenderer->render('assign', ['form' => $form, 'items' => ArrayHelper::index($this->itemsStorage->getAll(), 'name', 'type')]);
    }
}
