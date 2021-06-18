<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //table name
    protected $table = 'posts';
    //primarykey
    public $primaryKey = 'id';
    //timestamp
    public $timestamp = true;

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}