<?php

namespace App\Models;

use App\Enums\UserRole;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',
            'role' => UserRole::class,
        ];
    }

    public function pages(): BelongsToMany
    {
        return $this->belongsToMany(Page::class, 'user_page_permissions')
            ->withTimestamps();
    }

    public function hasPageAccess(string $routeName): bool
    {
        if ($this->hasFullAccess()) {
            return true;
        }

        return $this->pages()->where('route_name', $routeName)->active()->exists();
    }

    public function canAccessRouteName(string $routeName): bool
    {
        if ($this->hasFullAccess()) {
            return true;
        }

        $page = Cache::remember(
            'page_access.page_by_route.' . $routeName,
            now()->addMinutes(5),
            fn () => Page::where('route_name', $routeName)->active()->first()
        );

        if (!$page) {
            return true;
        }

        return Cache::remember(
            'page_access.has_access.page_' . $page->id . '.user_' . $this->id,
            now()->addMinutes(2),
            fn () => $page->users()->where('user_id', $this->id)->exists()
        );
    }

    public function getRole(): UserRole
    {
        return $this->role ?? UserRole::USER;
    }

    public function setRole(UserRole $role): void
    {
        $this->role = $role;
    }

    public function isAdmin(): bool
    {
        return $this->getRole() === UserRole::ADMIN || $this->isSuperAdmin();
    }

    public function isSuperAdmin(): bool
    {
        return $this->getRole() === UserRole::SUPERADMIN;
    }

    public function hasFullAccess(): bool
    {
        return $this->getRole()->hasFullAccess();
    }

    public function canManageUsers(): bool
    {
        return $this->getRole()->canManageUsers();
    }

    public function canManagePages(): bool
    {
        return $this->getRole()->canManagePages();
    }

    public function getRoleDisplayName(): string
    {
        return $this->getRole()->getDisplayName();
    }

    public function getRoleColor(): string
    {
        return $this->getRole()->getColor();
    }

    public function getAssignableRoles(): array
    {
        return $this->getRole()->getAssignableRoles();
    }

    // Backward compatibility
    public function getIsAdminAttribute(): bool
    {
        return $this->isAdmin();
    }
}
