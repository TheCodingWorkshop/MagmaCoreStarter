<?php

declare(strict_types=1);

namespace App\Model;

use MagmaCore\Base\AbstractBaseModel;
use App\Entity\UserEntity;

class UserModel extends AbstractBaseModel
{

    protected const TABLESCHEMA = 'users';
    protected const TABLESCHEMAID = 'id';

    public function __construct()
    {
        parent::__construct(self::TABLESCHEMA, self::TABLESCHEMAID, UserEntity::class);
    }

    public function guardedID(): array
    {
        return [];
    }

    public function emailExists(string $email, int $ignoreID = null): bool
    {
        if (!empty($email)) {
            $result = $this->getRepo()->findObjectBy(['email' => $email], ['*']);
            if ($result) {
                if ($result->id != $ignoreID) {
                    return true;
                }
            }
        }
        return false;
    }




}