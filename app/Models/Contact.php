<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['id', 'date', 'customer', 'isArchived', 'subject', 'comment'];
    protected $keyType = 'string';
}
