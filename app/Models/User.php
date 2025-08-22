<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];
    protected $guarded = ['id'];

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

    public static function cntAdmin() {
        $query = DB::table('users')->where('role','admin')->count();
        return $query;
    }

    public static function cntSuperAdmin() {
        $query = DB::table('users')->where('role','superadmin')->count();
        return $query;
    }

    public function isAdmin() {
        return ($this->role == "admin" | $this->role == "superadmin" ? true : false);
    }

    public function isSuperAdmin() {
        return ($this->role == "superadmin" ? true : false);
    }

    public function userLog() {
        return $this->hasMany(UserLog::class);
    }

    public function proposal() {
        return $this->hasMany(Proposal::class);
    }

    public function completeProposal() {
        return $this->hasOne(CompleteProposal::class);
    }
}
