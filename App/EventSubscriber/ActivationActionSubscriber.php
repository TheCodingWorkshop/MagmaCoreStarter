<?php

declare(strict_types=1);

namespace App\EventSubscriber;

use App\Event\ActivationActionEvent;
use MagmaCore\Auth\Authorized;
use MagmaCore\EventDispatcher\EventDispatcherTrait;
use MagmaCore\EventDispatcher\EventSubscriberInterface;

class ActivationActionSubscriber implements EventSubscriberInterface
{

    use EventDispatcherTrait;

    public static function getSubscribedEvents(): array
    {
        return [
            ActivationActionEvent::NAME => [
                ['flashLoginEvent']
            ]
        ];
    }

    public function flashLoginEvent(ActivationActionEvent $event)
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
