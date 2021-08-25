<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomKosan extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'type',
        'price',
        'location',
        'description'
    ];

    public function file() {
        return $this->hasOne(FileKosan::class,'id_room_kosans','id')
            ->select('id_room_kosans','file_kosan');
    }

    public function fasilitas() {
        return $this->hasOne(FasilitasRoom::class,'id_room_kosans','id')
            ->select('id_room_kosans','fasilitas_name');
    }

    public function is_type() {
        return $this->hasOne(MasterType::class,'id','type')
            ->select('id','name');
    }
}
