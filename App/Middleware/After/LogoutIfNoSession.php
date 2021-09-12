<?php

declare(strict_types=1);

namespace App\Middleware\After;

use Closure;
use MagmaCore\Auth\Authorized;
use MagmaCore\Middleware\AfterMiddleware;

class LogoutIfNoSession extends AfterMiddleware
{

    public function middleware(object $middleware, Closure $next)
    {
        if ($middleware->thisRouteController() === 'security' && $middleware->thisRouteAction() === 'logout') {
            if ($middleware->getSession()->get('user_id') === null) {
                $middleware->redirect('/');
            }
        }
        return $next($middleware);
    }

}