<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Leads;

class Company extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function Projects()
    {
        return $this->hasMany(Projects::class);
    }

    public function Leads()
    {
        return $this->hasMany(Leads::class);
    }
}
