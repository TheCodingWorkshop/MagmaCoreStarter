<?php

declare(strict_types=1);

namespace App\Model;

use MagmaCore\Base\AbstractBaseModel;
use App\Entity\UserRoleEntity;

class UserRoleModel extends AbstractBaseModel
{

    protected const TABLESCHEMA = 'user_role';
    protected const TABLESCHEMAID = 'id';

    public function __construct()
    {
        parent::__construct(self::TABLESCHEMA, self::TABLESCHEMAID, UserRoleEntity::class);
    }

    public function guardedID(): array
    {
        return [];
    }




}
