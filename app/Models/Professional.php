<?php

namespace App\Models;

use App\Models\People;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Professional extends Model
{
    use HasFactory;

    protected $fillable = ['people_id', 'register', 'speciality'];

    protected $hidden = ['created_at', 'updated_at'];

    public function people() {
        return $this->hasOne(People::class, 'id', 'people_id');
    }
}