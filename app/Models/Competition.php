<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'status', 'start', 'end'];
    public function clubs() {
        return $this->hasMany(Club::class);
    }
}
