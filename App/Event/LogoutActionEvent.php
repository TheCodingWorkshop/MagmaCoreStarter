<?php

declare(strict_types=1);

namespace App\Event;

use MagmaCore\Base\BaseActionEvent;

class LogoutActionEvent extends BaseActionEvent
{

    public const NAME = 'app.event.logout_action_event';
}
