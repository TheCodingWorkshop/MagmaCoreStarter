<?php

declare(strict_types=1);

namespace App\Repository;

use Exception;
use MagmaCore\Auth\Contracts\UserActivationInterface;
use MagmaCore\UserManager\UserModel;
use MagmaCore\Utility\Token;

class ActivationRepository extends UserModel implements UserActivationInterface
{

    private array $errors = [];
    private int $userID;
    private array $fields = [];

    /**
     * @throws Exception
     */
    public function findByActivationToken(string $token) : ?Object
    {
        $_token = new Token($token);
        $_tokenHash = $_token->getHash();
        $findBy = $this->getRepo()->findObjectBy(['activation_token' => $_tokenHash], ['*']);
        if (null !==$findBy) {
            return $findBy;
        }

        return null;
    }


    public function sendUserActivationEmail(string $hash) : self
    {}

    public function validateActivation(?object $repository) : self
    {
        if ($repository === null) {
            $this->errors['invalid_account'] = 'Sorry no user was found';
        }
        $this->userID = $repository->id;
        $this->fields = ['activation_token' => NULL, 'status' => 'active'];

        return $this;
    }


    public function activate() : bool
    {
        $update = $this->getRepo()->findByIdAndUpdate($this->fields, $this->userID);
        if ($update) {
            return true;
        }
        return false;

    }

    public function getError(): array
    {
        return $this->errors;
    }


}