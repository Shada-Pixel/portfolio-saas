<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Stancl\Tenancy\Database\TenantScope;

/**
 * Class FavoritePortfolio
 *
 * @property int $id
 * @property int $followerId
 * @property int $followingId
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Experience newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Experience newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Experience query()
 * @method static \Illuminate\Database\Eloquent\Builder|Experience whereFollowerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Experience whereFollowingId($value)
 * @property int $follower_id
 * @property int $following_id
 * @property-read \App\Models\User $user
 * @property-read \App\Models\User $users
 * @method static \Illuminate\Database\Eloquent\Builder|FavoritePortfolio whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FavoritePortfolio whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FavoritePortfolio whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class FavoritePortfolio extends Model
{
    use HasFactory;

    protected $table = 'favorite_portfolios';

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'follower_id'  => 'required',
        'following_id' => 'required',
    ];
    public $fillable = [
        'id',
        'follower_id',
        'following_id',
    ];
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'           => 'integer',
        'follower_id'  => 'integer',
        'following_id' => 'integer',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function users()
    {
        return $this->belongsTo(User::class, 'following_id', 'id')->withoutGlobalScope(new TenantScope());
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'follower_id', 'id')->withoutGlobalScope(new TenantScope());
    }
}
