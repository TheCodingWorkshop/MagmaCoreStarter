<?php

declare(strict_types=1);

namespace App\Controller;

use App\Event\RegistrationActionEvent;
use MagmaCore\UserManager\UserEntity;
use App\Forms\Client\Registration\RegisterForm;
use MagmaCore\Base\BaseController;
use MagmaCore\Base\Domain\Actions\NewAction;
use MagmaCore\UserManager\UserModel;

class RegistrationController extends BaseController
{

    public function __construct(array $routeParams)
    {
        parent::__construct($routeParams);

        $this->addDefinitions(
            [
                'newAction' => NewAction::class,
                'registerForm' => RegisterForm::class,
                'repository' => UserModel::class
            ]
        );
    }

    protected function registerAction()
    {
        $this->newAction
            ->execute($this, UserEntity::class, RegistrationActionEvent::class, NULL, __METHOD__)
            ->render()
            ->with()
            ->form($this->registerForm)
            ->end();
    }

}