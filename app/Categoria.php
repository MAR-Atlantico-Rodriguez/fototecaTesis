<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Categoria extends Model{
    protected $table = "categorias";

    protected $fillable = ['id','id_padre','categoria','id_users','block'];
    
    public function subcategoria(){
        return $this->hasMany(Categoria::class);
    }

    public function imagenesGaleria(){
        return $this->hasMany('App\Imagen','id_categoria')->orderBy('id','desc');
    }

    public function users(){
        return $this->belongsTo('App\User', 'id_users');
    }

    static function listaCategoriasProcedure($id){
        return DB::select('CALL categoriasLista('.$id.')');
    }
}
