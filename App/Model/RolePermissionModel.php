<?php

declare(strict_types=1);

namespace App\Model;

use MagmaCore\Base\AbstractBaseModel;
use App\Entity\RolePermissionEntity;

class RolePermissionModel extends AbstractBaseModel
{

    protected const TABLESCHEMA = 'role_permission';
    protected const TABLESCHEMAID = 'id';

    public function __construct()
    {
        parent::__construct(self::TABLESCHEMA, self::TABLESCHEMAID, RolePermissionEntity::class);
    }

    public function guardedID(): array
    {
        return [];
    }




}

