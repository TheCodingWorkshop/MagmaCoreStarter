<?php

declare(strict_types=1);

namespace App\Controller;

use App\Event\ActivationActionEvent;
use App\Repository\ActivationRepository;
use MagmaCore\Base\BaseController;
use MagmaCore\Base\Domain\Actions\ActivateAction;

class ActivationController extends BaseController
{

    public function __construct(array $routeParams)
    {
        parent::__construct($routeParams);

        $this->addDefinitions(
            [
                'activateAction' => ActivateAction::class,
                'repository' => ActivationRepository::class
            ]
        );
    }

    protected function activateAction()
    {
        $this->activateAction
            ->execute($this, NULL, ActivationActionEvent::class, NULL, __METHOD__)
            ->render()
            ->with()
            ->end();
    }

}