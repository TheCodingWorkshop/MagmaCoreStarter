<?php

declare(strict_types=1);

namespace App\Controller;

use App\Forms\Client\Security\LogoutForm;
use App\Middleware\After\LogoutIfNoSession;
use App\Middleware\Before\IsAlreadyLoggedIn;
use MagmaCore\Base\BaseController;
use App\Forms\Client\Security\LoginForm;
use MagmaCore\Base\Domain\Actions\LoginAction;
use MagmaCore\Auth\Authenticator;
use App\Model\UserModel;
use App\Event\LoginActionEvent;
use App\Event\LogoutActionEvent;
use MagmaCore\Base\Domain\Actions\LogoutAction;

class SecurityController extends BaseController
{

    public function __construct(array $routeParams)
    {
        parent::__construct($routeParams);

        $this->addDefinitions(
            [
                'loginForm' => LoginForm::class,
                'logoutForm' => LogoutForm::class,
                'loginAction' => LoginAction::class,
                'authenticator' => Authenticator::class,
                'repository' => UserModel::class,
                'logoutAction' => LogoutAction::class
            ]
        );
    }

    protected function callBeforeMiddlewares(): array
    {
        return [
            'IsAlreadyLoggedIn' => IsAlreadyLoggedIn::class
        ];
    }

    protected function callAfterMiddlewares(): array
    {
        return [
            'LogoutIfNoSession' => LogoutIfNoSession::class
        ];
    }

    protected function indexAction()
    {
        //$this->view('/client/security/index.html', ['login_form' => $this->loginForm->createForm('/security/index')]);
        $this->loginAction
            ->execute($this, NULL, LoginActionEvent::class, NULL, __METHOD__)
            ->render()
            ->with()
            ->form($this->loginForm)
            ->end();
    }

    protected function logoutAction()
    {
        $this->logoutAction
            ->execute($this, NULL, LogoutActionEvent::class, NULL, __METHOD__)
            ->render()
            ->with()
            ->form($this->logoutForm)
            ->end();
    }

}