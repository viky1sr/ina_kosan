<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VirtualAccount extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_users',
        'code_virtual',
        'tanggal_lahir',
        'status',
        'saldo',
        'code_pin',
    ];

    public function user(){
        return $this->hasOne(User::class,'id','id_users');
    }
}
