<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    // Определение полей, которые можно заполнить через методы create() и update()
    protected $fillable = ['filename', 'uploaded_at'];

    // Определение отношений с другими моделями, если они есть
    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    // Определение методов модели, если они есть
    // public function getFullPathAttribute()
    // {
    //     return asset('storage/images/' . $this->filename);
    // }
     protected static function booted()
{
        static::created(function ($image) {
            // Логика, которая будет выполнена после создания нового изображения
        });
    }
}
