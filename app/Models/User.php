<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    const ROLE_ADMIN = 'admin';

    const ROLE_EDITOR = 'editor';

    const ROLE_USER = 'user';

    const PERMISSION_PANEL_ACCESS = 'panel-access';

    const PERMISSION_POST_LISTING = 'post-listing';

    const PERMISSION_POST_ADD = 'post-add';

    const PERMISSION_POST_EDIT = 'post-edit';

    const PERMISSION_POST_DELETE = 'post-delete';

    const PERMISSION_USER_LISTING = 'user-listing';

    const PERMISSION_USER_ADD = 'user-add';

    const PERMISSION_USER_EDIT = 'user-edit';

    const PERMISSION_USER_DELETE = 'user-delete';
    
    const PERMISSION_USER_GRANT_PERMISSION = 'user-grant-permission';

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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function createdPosts(): HasMany
    {
        return $this->hasMany(BlogPost::class, 'created_by');
    }

    public function updatedPosts(): HasMany
    {
        return $this->hasMany(BlogPost::class, 'updated_by');
    }

    public static function validationRules(): array
    {
        return [
            'name' => 'required|min:3|max:15',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8'
        ];
    }
}
