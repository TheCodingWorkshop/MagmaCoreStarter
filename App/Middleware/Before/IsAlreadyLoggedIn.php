<?php

declare(strict_types=1);

namespace App\Middleware\Before;

use Closure;
use MagmaCore\Auth\Authorized;
use MagmaCore\Middleware\BeforeMiddleware;

class IsAlreadyLoggedIn extends BeforeMiddleware
{

    public function middleware(object $middleware, Closure $next)
    {
        if ($middleware->thisRouteController() === 'security' && $middleware->thisRouteAction() === 'index') {
            $userID = $middleware->getSession()->get('user_id');
            if (isset($userID) && $userID !==0) {
                $middleware->flashMessage('You are already logged in.');
                $middleware->redirect(Authorized::getReturnToPage());
            }
        }
        return $next($middleware);
    }

}