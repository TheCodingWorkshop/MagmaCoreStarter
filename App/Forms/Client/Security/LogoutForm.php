<?php

declare(strict_types=1);

namespace App\Forms\Client\Security;

use MagmaCore\FormBuilder\ClientFormBuilder;
use MagmaCore\FormBuilder\ClientFormBuilderInterface;
use MagmaCore\FormBuilder\FormBuilderBlueprint;
use MagmaCore\FormBuilder\FormBuilderBlueprintInterface;

class LogoutForm extends ClientFormBuilder implements ClientFormBuilderInterface
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
            ->add(
                $this->blueprint->submit('logout-security', ['uk-button', 'uk-button-primary'], 'Logout'),
                null,
                $this->blueprint->settings(false, null, false, null, true)
            )
            ->build(['before' => '<div class="uk-wrapper">', 'after' => '</div>']);
    }

}
