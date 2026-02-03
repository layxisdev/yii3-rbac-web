<?php

declare(strict_types=1);

namespace Layxis\Yii\Rbac\Web\Role;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Yiisoft\Http\Status;
use Yiisoft\Rbac\ManagerInterface;
use Yiisoft\Router\UrlGeneratorInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Yiisoft\Router\HydratorAttribute\RouteArgument;

final class DeleteAction
{
    public function __construct(
        private ManagerInterface $manager,
        private UrlGeneratorInterface $urlGenerator,
        private ResponseFactoryInterface $responseFactory
    ) {}

    public function __invoke(ServerRequestInterface $request, #[RouteArgument('name')] string $name): ResponseInterface
    {
        if ( $this->manager->getRole($name) === null) {
            return $this->responseFactory->createResponse(Status::NOT_FOUND);
        }
        $this->manager->removeRole($name);

        return $this->responseFactory
            ->createResponse(Status::FOUND)
            ->withHeader('Location', $this->urlGenerator->generate('role/index'));
    }
}