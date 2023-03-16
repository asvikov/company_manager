<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'address',
        'logo_url'
    ];

    public function getLogoUrlAttribute($data) {

        if($data) {
            return Storage::url($data);
        } else {
            return $data;
        }

    }

    public function workers() {

        return $this->belongsToMany('App\Models\Worker');
    }

    public function coordinates() {

        return $this->hasMany('App\Models\Coordinate');
    }
}
