<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\PersonalAccessToken;

/**
 * App\Models\User.
 *
 * @property int                                                                $id
 * @property string                                                             $name
 * @property string                                                             $email
 * @property null|\Illuminate\Support\Carbon                                    $email_verified_at
 * @property string                                                             $password
 * @property null|string                                                        $remember_token
 * @property null|\Illuminate\Support\Carbon                                    $created_at
 * @property null|\Illuminate\Support\Carbon                                    $updated_at
 * @property DatabaseNotificationCollection<int, DatabaseNotification>          $notifications
 * @property null|int                                                           $notifications_count
 * @property \Illuminate\Database\Eloquent\Collection<int, PersonalAccessToken> $tokens
 * @property null|int                                                           $tokens_count
 *
 * @method static \Database\Factories\UserFactory            factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 *
 * @property null|string                                                        $two_factor_secret
 * @property null|string                                                        $two_factor_recovery_codes
 * @property DatabaseNotificationCollection<int, DatabaseNotification>          $notifications
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Product> $products
 * @property null|int                                                           $products_count
 * @property \Illuminate\Database\Eloquent\Collection<int, PersonalAccessToken> $tokens
 *
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorRecoveryCodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorSecret($value)
 *
 * @property DatabaseNotificationCollection<int, DatabaseNotification>          $notifications
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Product> $products
 * @property \Illuminate\Database\Eloquent\Collection<int, PersonalAccessToken> $tokens
 *
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasUuids;
    use Notifiable;

    public $incrementing = true;

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
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}
