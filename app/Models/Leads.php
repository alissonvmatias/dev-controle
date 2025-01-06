<?php

namespace App\Models;
use App\Models\Company;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Leads extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
