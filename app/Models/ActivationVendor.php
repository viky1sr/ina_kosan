<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivationVendor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_kosan',
        'no_hp_kosan',
        'address',
        'reason',
        'file_pendukung',
        'id_users'
    ];

    public function user(){
        $this->hasOne(User::class,'id','id_users');
    }
}
