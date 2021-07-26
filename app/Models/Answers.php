<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answers extends Model
{
    use HasFactory;
    protected $table = 'prot_answers';
    protected $fillable = ['ID_Answer','ID_Question','Remember','Answer'];
}