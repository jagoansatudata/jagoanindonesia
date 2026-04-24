<?php

namespace App\Enums;

enum UserRole: string
{
    case USER = 'user';
    case ADMIN = 'admin';
    case SUPERADMIN = 'superadmin';

    /**
     * Get the display name for the role
     */
    public function getDisplayName(): string
    {
        return match($this) {
            self::USER => 'User',
            self::ADMIN => 'Admin',
            self::SUPERADMIN => 'Super Admin',
        };
    }

    /**
     * Get the color for the role badge
     */
    public function getColor(): string
    {
        return match($this) {
            self::USER => 'gray',
            self::ADMIN => 'blue',
            self::SUPERADMIN => 'emerald',
        };
    }

    /**
     * Check if role can manage other users
     */
    public function canManageUsers(): bool
    {
        return match($this) {
            self::USER => false,
            self::ADMIN => true,
            self::SUPERADMIN => true,
        };
    }

    /**
     * Check if role can manage pages
     */
    public function canManagePages(): bool
    {
        return match($this) {
            self::USER => false,
            self::ADMIN => true,
            self::SUPERADMIN => true,
        };
    }

    /**
     * Check if role has full system access
     */
    public function hasFullAccess(): bool
    {
        return match($this) {
            self::USER => false,
            self::ADMIN => false,
            self::SUPERADMIN => true,
        };
    }

    /**
     * Get all roles as array for select options
     */
    public static function getSelectOptions(): array
    {
        return [
            self::USER->value => self::USER->getDisplayName(),
            self::ADMIN->value => self::ADMIN->getDisplayName(),
            self::SUPERADMIN->value => self::SUPERADMIN->getDisplayName(),
        ];
    }

    /**
     * Get roles that can be assigned by current role
     */
    public function getAssignableRoles(): array
    {
        return match($this) {
            self::USER => [],
            self::ADMIN => [self::USER->value => self::USER->getDisplayName()],
            self::SUPERADMIN => self::getSelectOptions(),
        };
    }

    /**
     * Get all role values as array
     */
    public static function getValues(): array
    {
        return array_map(fn($role) => $role->value, self::cases());
    }
}
