<?php

namespace App\Models;

use App\Models\Concerns\HandlesMediaColumns;
use Database\Factories\UserFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Sanctum\HasApiTokens;
use Laravolt\Avatar\Facade as Avatar;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;

/**
 * @phpstan-use HasFactory<UserFactory>
 */
class User extends Authenticatable implements MustVerifyEmail, HasMedia
{
    use HasFactory, HasApiTokens, Notifiable, SoftDeletes, HasRoles, LogsActivity, InteractsWithMedia, TwoFactorAuthenticatable, HandlesMediaColumns;

    /**
     * @var list<string>
     */
    protected array $mediaColumns = ['avatars'];

    protected $fillable = [
        'name',
        'email',
        'password',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'email', 'is_active'])
            ->logOnlyDirty()
            ->dontLogEmptyChanges()
            ->setDescriptionForEvent(fn (string $eventName) => "User has been {$eventName}");
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatars')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp']);
    }

    public function getAvatarUrlAttribute(): string
    {
        $media = $this->getFirstMedia('avatars');

        if ($media) {
            return $media->getUrl('thumb');
        }

        return Avatar::create($this->name)->toBase64();
    }
}
