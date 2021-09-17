<?php

declare(strict_types=1);

namespace App\EventSubscriber;

use App\Event\RegistrationActionEvent;
use MagmaCore\Auth\Authorized;
use MagmaCore\EventDispatcher\EventDispatcherTrait;
use MagmaCore\EventDispatcher\EventSubscriberInterface;

class RegistrationActionSubscriber implements EventSubscriberInterface
{

    use EventDispatcherTrait;

    public static function getSubscribedEvents(): array
    {
        return [
            RegistrationActionEvent::NAME => [
                ['flashRegisterEvent']
            ]
        ];
    }

    public function flashRegisterEvent(RegistrationActionEvent $event)
    {
        $this->flashingEvent(
            $event,
            /**
             * As we are dealing with modal for adding and editing roles we want to redirect
             * back to the role index page.
             */
            function ($cbEvent, $actionRoutes) {
                $cbEvent->getObject()->redirect(Authorized::getReturnToPage());
            }
        );
    }

}