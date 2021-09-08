<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KontrakSewa extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_users',
        'id_room_kosans',
        'lama_sewa',
        'mulai_sewa',
        'status',
    ];

    public function info_payment() {
        return $this->hasOne(InfoPembayaranBulanan::class,'id_users','id_users');
    }

    public function kosan() {
        return $this->hasOne(RoomKosan::class,'id','id_room_kosans');
    }

    public function bukti_tf(){
        return $this->hasOne(BuktiTransfer::class,'id_kontrak_sewa','id');
    }
}
