<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categorias';
	
	public $timestamps = false;
    
    protected $fillable = array('nome');

    public function posts(){
    	return $this->hasMany(Post::Class);
    }
}
