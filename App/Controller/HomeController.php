<?php

declare(strict_types=1);

namespace App\Controller;

use MagmaCore\Base\BaseController;
use App\Model\ExampleModel;

class HomeController extends BaseController
{

    public function __construct(array $routeParams)
    {
        parent::__construct($routeParams);

        $this->addDefinitions([]);
    }

    protected function indexAction()
    {
        $this->view('/client/home/index.html', [
            'first_car' => 'Ford',
            'first_pet' => 'Cat'
        ]);
    }

}