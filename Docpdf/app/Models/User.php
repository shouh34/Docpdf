<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Documents;
use Illuminate\Database\Eloquent\Collection;


#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

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
        ];
    }

    public function documents(): HasMany
    {
        return $this->hasMany(Documents::class);

    }
// Userクラスの中に追加
public function friendshipsSent(): HasMany
{
    return $this->hasMany(Friendship::class, 'from_user_id');
}

public function friendshipsReceived(): HasMany
{
    return $this->hasMany(Friendship::class, 'to_user_id');
}

public function friends(): \Illuminate\Database\Eloquent\Collection
{
    $friendIds = Friendship::where('status', 'accepted')
        ->where(function ($query) {
            $query->where('user_id', $this->id)
                ->orWhere('friend_id', $this->id);
        })
        ->get()
        ->map(function ($friendship) {
            return $friendship->user_id == $this->id
                ? $friendship->friend_id
                : $friendship->user_id;
        });

    return User::whereIn('id', $friendIds)->get();
}
}
