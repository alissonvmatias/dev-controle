<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Projects extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function Company()
    {
        return $this->belongsTo(Company::class);
    }
}
