<?php

declare(strict_types=1);

namespace App\Forms\Client\Registration;

use MagmaCore\FormBuilder\ClientFormBuilder;
use MagmaCore\FormBuilder\ClientFormBuilderInterface;
use MagmaCore\FormBuilder\FormBuilderBlueprint;
use MagmaCore\FormBuilder\FormBuilderBlueprintInterface;

class RegisterForm extends ClientFormBuilder implements ClientFormBuilderInterface
{
    private FormBuilderBlueprintInterface $blueprint;

    public function __construct(FormBuilderBlueprint $blueprint)
    {
        $this->blueprint = $blueprint;
        parent::__construct();
    }

    /**
     * @throws \Exception
     */
    public function createForm(string $action, ?object $dataRepository = null, ?object $callingController = null): string
    {
        return $this->form()
            ->add($this->blueprint->text('firstname'))
            ->add($this->blueprint->text('lastname'))
            ->add($this->blueprint->email('email'))
            ->add(
                $this->blueprint->password('password_hash'),
                null,
                $this->blueprint->settings(false, null, true, 'Password')
            )
            ->add(
                $this->blueprint->submit('register-registration', [], 'Register new account'),
                null,
                $this->blueprint->settings(false, null, false)
            )
            ->build(['before' => '<div class="uk-wrapper">', 'after' => '</div>']);
    }

}