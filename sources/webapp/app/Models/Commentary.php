<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentary extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_x_commentaries', 'commentary_id', 'user_id');
    }

    public function editors()
    {
        return $this->users()->where('role_id', 2);
    }

    public function authors()
    {
        return $this->users()->where('role_id', 3);
    }

    public function proofreaders()
    {
        return $this->users()->where('role_id', 4);
    }
    
}
