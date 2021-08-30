<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuktiTransfer extends Model
{
    use HasFactory;

    protected $fillable = [
      'user_id',
      'status',
      'nominal',
      'bukti_transfer'
    ];

    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }

    public function vitual(){
        return $this->hasOne(VirtualAccount::class,'id_users','user_id');
    }
}
