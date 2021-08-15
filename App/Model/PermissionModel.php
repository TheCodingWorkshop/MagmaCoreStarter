<?php

declare(strict_types=1);

namespace App\Model;

use MagmaCore\Base\AbstractBaseModel;
use App\Entity\PermissionEntity;

class PermissionModel extends AbstractBaseModel
{

    protected const TABLESCHEMA = 'permissions';
    protected const TABLESCHEMAID = 'id';

    public function __construct()
    {
        parent::__construct(self::TABLESCHEMA, self::TABLESCHEMAID, PermissionEntity::class);
    }

    public function guardedID(): array
    {
        return [];
    }




}
