<?php

namespace App\Models;

use App\Models\Offers\Offers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class method extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'cash_tag'
    ];
    
    public function methods_users(){
        return $this->belongsToMany(User::class, 'user_method','method_id','user_id')->withPivot('cash_tag');
    }
    public function methods_offers(){
        return $this->belongsToMany(Offers::class, 'offers_methods','method_id','offer_id');
    }
}
