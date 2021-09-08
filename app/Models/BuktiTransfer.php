<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuktiTransfer extends Model
{
    use HasFactory;

    protected $fillable = [
      'id_users',
      'status',
      'nominal',
      'bukti_transfer',
        'id_kontrak_sewa'
    ];

    public function user(){
        return $this->hasOne(User::class,'id','id_users');
    }

    public function vitual(){
        return $this->hasOne(VirtualAccount::class,'id_users','id_users');
    }
}
