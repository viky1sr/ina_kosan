<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogPembayaran extends Model
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
        'id_virtual_accounts',
        'id_info_pembayaran',
        'id_kontrak_sewas',
        'status','total_pembayaran'
    ];

    protected $with = ['room_kosan','info_pembayaran','kontrak_sewa','user'];

    public function room_kosan(){
        return $this->hasOne(RoomKosan::class,'id','id_room_kosans');
    }

    public function info_pembayaran() {
     return $this->hasOne(InfoPembayaranBulanan::class,'id','id_info_pembayaran');
    }

    public function kontrak_sewa() {
        return $this->hasOne(KontrakSewa::class,'id','id_kontrak_sewas');
    }

    public function user() {
        return $this->hasOne(User::class,'id','id_users')
            ->select('id','name');
    }
}
