<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    // mendeklasrasikan model bernama todo
    protected $table = 'todo';
    // menentukan kolom mana aja yang bisa diubah dan diisi
    protected $fillable = ['task','is_done']; 
}
