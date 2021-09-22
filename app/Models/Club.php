<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'status', 'competition_id', 'user_id'];

    public function competition() {
        return $this->belongsTo(Competition::class);
    }
    public function users() {
        return $this->hasMany(User::class);
    }
    public function user() {
        return $this->belongsTo(User::class);
    }

}
