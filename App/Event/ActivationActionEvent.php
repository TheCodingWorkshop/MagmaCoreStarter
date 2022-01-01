<?php

declare(strict_types=1);

namespace App\Event;

use MagmaCore\Base\BaseActionEvent;

class ActivationActionEvent extends BaseActionEvent
{

    public const NAME = 'app.event.activation_action_event';
}
