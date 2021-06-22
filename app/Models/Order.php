<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public $dates = ['schedule_at'];

    public function getTaxsAttribute()
    {
        return $this->total * 0.05;
    }

    public function getStatusAttribute($value)
    {
        if ($value == 'TBC') {
            return '確認中';
        } elseif ($value == 'TBP') {
            return '備餐中';
        } elseif ($value == 'ALC') {
            return '備餐完成';
        } elseif ($value == 'ALD') {
            return '已出餐';
        } else {
            return '已取消';
        }
    }

    public function setReceiveNameAttribute($value)
    {
        $this->attributes['receive_name'] = 'Name:' . $value;
    }
}
