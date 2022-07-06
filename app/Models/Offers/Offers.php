<?php

namespace App\Models\Offers;

use App\Models\method;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Offers extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'price',
        'offer_type',
        'status',
        'payment_method'
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
    public function offer_methods(){
        return $this->belongsToMany(method::class, 'offers_methods','offer_id','method_id');
    }
}
