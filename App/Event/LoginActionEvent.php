<?php

declare(strict_types=1);

namespace App\Event;

use MagmaCore\Base\BaseActionEvent;

class LoginActionEvent extends BaseActionEvent
{

    public const NAME = 'app.event.login_action_event';
}
