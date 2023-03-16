<?php

namespace App\Models;

use App\Services\PortrayPhoneService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory;

    protected $hidden = ['pivot'];

    protected $fillable = [
        'name',
        'email',
        'phone',
    ];

    public function companies() {

        return $this->belongsToMany('App\Models\Company');
    }

    public function getPhoneAttribute($data) {

        return PortrayPhoneService::portrayForView($data);
    }

    public function setPhoneAttribute($data) {

        $this->attributes['phone'] = PortrayPhoneService::portrayForDB($data);
    }
}
