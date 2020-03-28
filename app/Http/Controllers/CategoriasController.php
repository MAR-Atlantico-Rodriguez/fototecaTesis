<?php

namespace App\Http\Controllers;

use App\Categoria;
use Illuminate\Http\Request;

class CategoriasController extends Controller {

	public function __construct() {
		$this->middleware('auth');
	}

	public function lista($id = 0) {
		$categoria = '';
		$idCategoriaPadre = 0;
		if ($id) {
			$catPadre = Categoria::where('id', $id)->get()[0];
			$categoria = $catPadre->categoria;
			$idCategoriaPadre = $catPadre->id_padre;
		}
		/*$categorias_padres = Categoria::select('categorias.id,
			                                                categorias.categoria,
			                                                COUNT(imagenes.id) AS cantImagen,
			                                                (SELECT count(*) FROM categorias AS CC where
			                                                CC.id_padre = C.id) AS cantSubCat')
			                            ->join('imagenes', 'imagenes.id_categoria', '=', 'categoria.id')
		*/
		$categorias_padres = Categoria::listaCategoriasProcedure($id);

		$datos = ['categorias_padres' => $categorias_padres,
			'id' => $id,
			'categoriaPadre' => $categoria,
			'idCategoriaPadre' => $idCategoriaPadre,
		];
		return view('categorias/lista', $datos);
		//dd(Categoria::where('id_padre',$id)->get());
	}

	public function formulario($id_padre, $id_categoria = 0) {
		$catPadreNombre = ' - ';
		if ($id_padre) {
			$catPadre = Categoria::where('id', $id_padre)->get()[0];
			$catPadreNombre = $catPadre->categoria;
		}
		$n_e = ($id_categoria == 0) ? 'Nueva' : 'Editar la';
		$texInput = '';

		if ($id_categoria > 0) {
			$cat = Categoria::where('id', $id_categoria)
				->where('id_padre', $id_padre)
				->get()[0];
			$texInput = $cat->categoria;
		}
		$datos = ['id_padre' => $id_padre,
			'n_e' => $n_e,
			'catPadreNombre' => $catPadreNombre,
			'id_categoria' => $id_categoria,
			'texInput' => $texInput];
		return view('categorias/formCategoria', $datos);
	}

	public function NuevaEditarCategoria(request $r) {

		$id = $r->id_categoria;
		$categoria = $r->categoria;
		$categoriaPadre = ($r->categoriaPadre > 0) ? $r->categoriaPadre : 0;

		//Crea una categoria
		if ($id == 0) {
			$Categoria = new Categoria;
		}
		//Edita la categoria
		else {
			$Categoria = Categoria::find($id);
		}

		$Categoria->categoria = $categoria;
		$Categoria->id_padre = $categoriaPadre;
		// $Categoria->id_users = Auth::user()->id;
		if ($Categoria->save()) {
			if ($id == 0) {
				//Creo una carpeta para la categoria creada
				mkdir(public_path("imagenes/" . $Categoria->id), 0777);
				chmod(public_path("imagenes/" . $Categoria->id), 0777);
			}
			return redirect(url('categorias/lista/' . $r->categoriaPadre));
		} else {
			echo 'Error no se pudo crear la CATEGORIA!';
		}
	}

	public function block(Request $r) {
		$categoria = Categoria::find($r->idCategoria);
		$categoria->block = $r->block;
		$categoria->save();
		$this->blockCategoriasHijas($categoria->id, $r->block);
		return redirect(url('categorias/lista/' . $categoria->id_padre));
	}

	public function blockCategoriasHijas($id, $block) {
		$categoria = Categoria::where('id_padre', $id)->get();
		foreach ($categoria as $k => $v) {
			$v->block = $block;
			$this->blockCategoriasHijas($v->id, $block);
			$v->save();
		}
	}

}
