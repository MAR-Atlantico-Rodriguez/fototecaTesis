<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class Recorte extends Model{
	protected $table = "recortes";

    protected $fillable = [
        'id_imagen', 'id_user', 'url'
    ];

    public function recortesDeUnaImagen($id){    	
    	return DB::table($this->table) 
                 ->select(DB::raw('users.name, recortes.url, recortes.created_at, recortes.id'))
                ->join('users', 'users.id', '=', 'recortes.id_user')                
                ->where('recortes.id_imagen',$id) 
                ->get();
    }

    public function urlImg($id){
    	return DB::table($this->table)->select("url")->where('recortes.id',$id)->get();
    }
}