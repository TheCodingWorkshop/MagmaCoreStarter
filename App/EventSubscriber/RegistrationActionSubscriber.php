<?php

declare(strict_types=1);

namespace App\EventSubscriber;

use App\Event\RegistrationActionEvent;
use MagmaCore\Auth\Authorized;
use MagmaCore\Base\BaseView;
use MagmaCore\EventDispatcher\EventDispatcherTrait;
use MagmaCore\EventDispatcher\EventSubscriberInterface;
use MagmaCore\Mailer\Exception\MailerException;
use MagmaCore\Mailer\MailerFacade;

class RegistrationActionSubscriber implements EventSubscriberInterface
{

    use EventDispatcherTrait;

    protected const ACTIVATION_PATH = '/activation/activate';

    private MailerFacade $mailer;
    private BaseView $view;

    public function __construct(MailerFacade $mailer, BaseView $view)
    {
        $this->mailer = $mailer;
        $this->view = $view;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            RegistrationActionEvent::NAME => [
                ['flashRegisterEvent', -1000],
                ['sendRegistrationActivationEmail']
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

    private function templateMessage(RegistrationActionEvent $event, array $user): string
    {
        $link = $event->getObject()->getSiteUrl(self::ACTIVATION_PATH . '/' . $user['activation_hash']);
        $html = '<div>';
        $html .= '<h1>Activate Your Account</h1>';
        $html .= isset($user['random_pass']) ? '<p><strong>Temporary Password</strong>' . ' ' . $user['random_pass'] . '</p>' : '';
        $html .= 'Please click the link to activate your account. Please also make a note of your temporary password.';
        $html .= '<p><a href="' . $link . '">Activate now</a></p>';
        $html .= '</div>';

        return $html;

    }

    /**
     * @throws MailerException
     */
    public function sendRegistrationActivationEmail(RegistrationActionEvent $event): bool
    {
        if ($this->onRoute($event, 'register')) {
            $user = $this->flattenContext($event->getContext());
            if (is_array($user) && count($user) > 0) {
                $mail = $this->mailer->basicMail(
                    'New Account',
                    'admin@example.com',
                    $user['email'],
                    $this->templateMessage($event, $user)
                );
                if ($mail) {
                    return true;
                }
            }
        }

        return false;
    }

}