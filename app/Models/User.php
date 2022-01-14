<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**Roles*/
    public const ROLE_ADMIN = 'admin';
    public const ROLE_CONTRIBUTOR = 'contributor';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'email', 'role',
        'password', 'username'
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

    /**
     * Set the user's password as hash
     *
     * @param  string  $value
     * 
     * @return void
    */
    public function setPasswordAttribute(string $value) : void
    {
        $this->attributes['password'] = \Hash::make($value);
    }

    /**
     * Set the user's username
     * 
     * @param string $value
     * 
     * @return void
    */
    public function setUsernameAttribute(string $value) : void
    {
        $username = $this->generateUniqueUsername($value) ;

        $this->attributes['username'] = $username;
    }

    /**
     * Generate unique username
     * 
     * @param string $data
     * 
     * @return string
    */
    public function generateUniqueUsername(string $username) : string
    {
        $usernames = User::where( 'username', 'like', $username.'%' )->get();

        if( ! $usernames->contains( 'username', $username ) ) {
            return $username;
        }

        $i = 1;
        $isContain = true;
        do {
            $newUsername = $username . '-' . $i;
            if ( ! $usernames->contains( 'username', $newUsername ) ) {
                $isContain = false;
                $username = $newUsername;
            }
            $i++;

        } while( $isContain );

        return $username;
    }

    /**
     * Post relationship
    */
    public function posts()
    {
        return $this->hasMany( Post::class, 'author_id' );
    }

    /**
     * Check if the user is an admin
     *
     * @return bool
     */
    public function isAdmin()
    {
        return static::ROLE_ADMIN === $this->role;
    }

    /**
     * Check if the user is an admin
     *
     * @return bool
     */
    public function isContributor()
    {
        return static::ROLE_CONTRIBUTOR === $this->role;
    }


    /**
     * Redirect user based on role
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function roleBasedRedirect()
    {
        if ($this->isAdmin()) {
            return redirect()->route('admin');
        }


        return redirect()->route('home');
    }
}
