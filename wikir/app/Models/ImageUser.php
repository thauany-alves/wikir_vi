<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ImageUser extends Model
{
    protected $table = 'images_user';

    protected $fillable = array('img_user','user_id');

    protected $guarded = ['id'];

    public $timestamps =false;

    public function verifica_image(){
    	$user_id = auth()->user()->id;
    	$image = DB::table('users')
            ->join('images_user', 'users.id', '=', 'images_user.user_id')
            ->select('images_user.*')
            ->where('users.id', '=', $user_id)
            ->get()->first();

        $existe = true;

        if(empty($image->id)){
        	$existe = false;
        }


        return $existe;
    }
}
