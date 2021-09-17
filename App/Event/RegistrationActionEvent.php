<?php

declare(strict_types=1);

namespace App\Event;

use MagmaCore\Base\BaseActionEvent;

class RegistrationActionEvent extends BaseActionEvent
{
    public const NAME = 'app.event.registration_action_event';
}

