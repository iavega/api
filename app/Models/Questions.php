<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    use HasFactory;
    protected $table = 'prot_question';
    protected $fillable = ['CreationDate','PointAsig','Question','ID_correctAnswer','Level'];
}