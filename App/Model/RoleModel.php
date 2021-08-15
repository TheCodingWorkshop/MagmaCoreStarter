<?php

declare(strict_types=1);

namespace App\Model;

use MagmaCore\Base\AbstractBaseModel;
use App\Entity\RoleEntity;

class RoleModel extends AbstractBaseModel
{

    protected const TABLESCHEMA = 'roles';
    protected const TABLESCHEMAID = 'id';

    public function __construct()
    {
        parent::__construct(self::TABLESCHEMA, self::TABLESCHEMAID, RoleEntity::class);
    }

    public function guardedID(): array
    {
        return [];
    }




}

