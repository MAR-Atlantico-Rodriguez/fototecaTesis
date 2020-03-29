<?php

namespace App\Http\Controllers;

use App\ImagenTag;
use App\LogsMio;
use App\Tag;
use Auth;
use Illuminate\Http\Request;

class TagsController extends Controller {

	public function __construct() {
		$this->middleware('auth');
	}

	public function lista() {
		return view('tags/lista', ['tags' => Tag::all()]);
	}

	public function block(Request $r) {
		$tag = Tag::find($r->idTag);
		$tag->block = $r->block;
		$tag->save();
		return redirect('tags/lista');
	}

	//new TAG
	//Vista nuevo tag
	public function newTagForm() {
		return view('tags/tagForm', ['id' => 0, 'tag' => (object) array('tag' => '')]);
	}
	//Vista de Edicion
	public function editTagForm($id) {
		$tag = Tag::find($id);
		return view('tags/tagForm', ['id' => $id, 'tag' => $tag]);
	}

	//Guarda o edita el TAG
	public function editAndNewTag(Request $r) {
		if ($r->id == 0) {
			//Nuevo TAG
			$tag = new Tag();
			$createUpdate = 1;
			// $tag->id_users = Auth::user()->id;
		} else {
			//Edita el TAG
			$tag = Tag::find($r->id);
			$createUpdate = 3;
		}
		$tag->tag = $r->tag;
		$tag->save();

		LogsMio::insertLog($createUpdate, Auth::user()->id, 'tags', $tag->id);

		return redirect('tags/lista');
	}

	//Tags, busqueda para el formulario de carga de FOTOS

	public function busqueda(Request $request) {
		$term = trim($request->q);
		if (empty($term)) {
			return \Response::json([]);
		}
		//select * from tags where id not in ( select id_tag from imagen_tags where id_imagen = 28)
		if (!empty($request->id)) {
			//utilice esta variable global, para poder entrar entro de la funcion
			//que utiliza la consulta, si no, no la ve a la variable!
			$GLOBALS['id_imagen'] = $request->id;
			$tags = Tag::where('tag', 'LIKE', "%$term%")
				->whereNotIn('id', function ($query) {
					$query->select('id_tag')
						->from('imagen_tags')
						->where('id_imagen', $GLOBALS['id_imagen']);})
				->where('block', 1)
				->limit(5)
				->get();
		} else {
			$tags = Tag::where('tag', 'LIKE', '%' . $term . '%')
				->where('block', 1)
				->limit(5)
				->get();
		}

		$formatted_tags = [];
		foreach ($tags as $tag) {
			$formatted_tags[] = ['id' => $tag->id, 'text' => $tag->tag];
		}
		return \Response::json($formatted_tags);
	}

	public function eliminarTag(Request $r) {
		echo $r->input('id_imagen');
		$tag = ImagenTag::where('id_imagen', $r->input('id_imagen'))->where('id_tag', $r->input('id_tag'))->delete();
		echo $tag;
	}

}
