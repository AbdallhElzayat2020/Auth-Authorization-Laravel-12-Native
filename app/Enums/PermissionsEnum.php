<?php

namespace App\Enums;

enum PermissionsEnum: string
{
    //Role Permissions
    case VIEW_ROLES = 'view_roles';
    case VIEW_ROLE = 'view_role';
    case DELETE_ROLE = 'delete_role';
    case UPDATE_ROLE = 'update_role';
    case CREATE_ROLE = 'create_role';

    // User Permissions
    case VIEW_USERS = 'view_users';
    case CHANGE_USER_ROLES = 'change_user_roles';


    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
