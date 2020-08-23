<?php

namespace Api;

use AppContainer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Router;

final class AppKernel implements HttpKernelInterface
{
    private AppContainer $container;

    /**
     * AppKernel constructor.
     * @param AppContainer $container
     */
    public function __construct(AppContainer $container)
    {
        $this->container = $container;
    }

    public function handle(Request $request, int $type = self::MASTER_REQUEST, bool $catch = true)
    {
        /** @var Router $routing */
        $routing = $this->container->get('routing');
        $context = new RequestContext();
        $context->fromRequest($request);
        $routing->setContext($context);

        $route = $routing->matchRequest($request);
        $request->attributes->replace($route);
        [$controller, $method] = explode(':', $route['_controller'], 2);

        return $this->container->get($controller)->{$method.'Action'}($request);
    }
}