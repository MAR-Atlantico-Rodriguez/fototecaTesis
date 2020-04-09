<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Imagen;
use App\ImagenTag;
use App\LogsMio;
use App\Recorte;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Image;
use Session;

class FototecaController extends Controller {
	public $arbolCategoria = [];
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		return view('fototeca/index', ["categorias" => $this->getCategories(),
			"ultimasDoceImagenes" => Imagen::limit(12)->orderBy('id', "desc")->get(),
			"cantidad_imagenes" => $this->imagen_espacio()]);
		//dd($this->getCategories());
	}

	private function getCategories($id = 0) {
		$categories = [];
		foreach ($this->categorias($id) as $category) {
			$categories[] = [
				'item' => $category,
				'children' => $this->getCategories($category->id),
			];
		}
		return $categories;
	}

	public function categorias($id) {
		return Categoria::where('id_padre', $id)
			->where('block', 1)
			->orderBy('categoria', 'asc')
			->get();

	}

	public function getAllCategories() {
		return Categoria::orderBy('categoria', 'asc')->get();
	}

	public function getNameCategorie($id) {
		return Categoria::where('id', $id)->get()[0]->categoria;
	}

	public function newCategoria(request $r) {
		$id = $r->id;
		$categoria = $r->categoria;
		$categoriaPadre = ($r->categoriaPadre != "") ? $r->categoriaPadre : 0;

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
			return 1;
		} else {
			return 0;
		}
	}

	////////////////////IMAGENES

	public function newImage($id) {

		return view('fototeca/formularioFotos', ["categorias" => $this->getCategories(),
			"categoriasSelect" => $this->getAllCategories(),
			"categoriaSeleccionada" => $this->getNameCategorie($id),
			"idCategoria" => $id,
			"cantidad_imagenes" => $this->imagen_espacio()]);
	}

	public function newImagenUP(Request $request) {
		$images = $request->file('image');

		$id_categoria = request()->input('idCategoria');

		$rules = ['titulo' => 'required|max:200',
			'fecha' => 'required|date'];
		$messages = [
			'titulo.max' => 'El máximo permitido es 200 Catacteres',
			'titulo.required' => 'Coloque un titulo',

			'fecha.date' => 'Seleccione una fecha',
			'fecha.required' => 'La fecha es requerida',
		];

		$validator = Validator::make($request->all(), $rules, $messages);
		if ($validator->fails()) {
			return redirect('newImage/' . request()->input('idCategoria') . '/' . $request->input('categoriaSeleccionada'))->withErrors($validator);
		} else {

			//$rules = ['image' => 'required|image|max:100024*10024',];
			$rules = ['image' => 'required'];
			$messages = [
				'image.required' => 'La imagen es requerida',
				//'image.image' => 'Formato no permitido',
				//'image.max' => 'El máximo permitido es 2 MB',
			];
			foreach ($images as $k => $image) {

				$validator = Validator::make(array('image' => $image), $rules, $messages);

				if ($validator->fails()) {
					return redirect('newImage/' . request()->input('idCategoria') . '/' . $request->input('categoriaSeleccionada'))->withErrors($validator);
				} else {
					//Public/Imagenes/.....
					$nombreImagen = md5(time() . $image->getClientOriginalName());
					$url = 'public/imagenes/' . $id_categoria . '/' . $nombreImagen;
					$path = ($url . '_we.jpg'); //Formato WEB 700px
					$path_th = ($url . '_th.jpg'); //Formato Thumbs 255px
					$path_G = ($url . '_gr.jpg'); //Formato Grande 2100PX o tamaño Original
					$path_db = $url . '.jpg'; //Direccion de la base de datos generica

					$img = Image::make($image->getRealPath())->encode('jpg');
					$img_th = Image::make($image->getRealPath())->encode('jpg');
					$img_Grande = Image::make($image->getRealPath())->encode('jpg');

					$img->resize(700, null, function ($constraint) {
						$constraint->aspectRatio();
					});

					$img_th->resize(255, null, function ($constraint) {
						$constraint->aspectRatio();
					});

					//IMAGEN GRANDE
					$W_H = getimagesize($image); //Tamaño de la imagen

					//Si el Ancho de la imagen es mayor que 2100PX, entonces la reduce a 2100PX
					//SI NO, Deja el tamaño original!!!
					if ($W_H[0] > '2100') {
						$img_Grande->resize(2100, null, function ($constraint) {
							$constraint->aspectRatio();
						});
					}

					// 0 HORIZONTAL - 1 VERTICAL
					$vertical_horizontal = ($W_H[0] >= $W_H[1]) ? 0 : 1;

					//Verifico la categoria si existe la CARPETA
					if (!is_dir(public_path("imagenes/" . $id_categoria))) {
						//Creo una carpeta para la categoria
						mkdir(public_path("imagenes/" . $id_categoria), 0777);
					}

					//Guardo las imagenes
					$img->save($path); //Imagen Web 700PX
					$img_th->save($path_th); //Imagen Thumb 255PX
					$img_Grande->save($path_G); //Imagen Grande 2100PX

					//Guardo en Base de datos!
					$imagen = new Imagen();
					$imagen->id_categoria = $id_categoria;
					// $imagen->id_user = Auth::user()->id;
					$imagen->titulo = request()->input('titulo');
					$imagen->descripcion = request()->input('descripcion');
					$imagen->foto_orientacion = $vertical_horizontal;
					$imagen->foto_color = (isset($request->cob_n) ? 1 : 0);
					$imagen->repositorio = (isset($request->repositorio) ? 1 : 0);
					$imagen->url = $path_db;

					$imagen->fecha = request()->input('fecha');
					$save = $imagen->save();
					// Guardo en la tabla LOG quien Crea
					LogsMio::insertLog(1, Auth::user()->id, 'imagenes', $imagen->id, $imagen->id);

					if ($save) {
						//Guardo los TAGS de la imagen
						$array = [];
						foreach (request()->input('tags') as $Tk => $Tv) {
							$a = array('id_imagen' => $imagen->id, 'id_tag' => $Tv);
							// 'id_users' => Auth::user()->id);
							$array[] = $a;
						}
						// dd($array);
						if (count($array)) {
							ImagenTag::insert($array);
						}
					}

				}
			} //FIN DEL FOREACH
		} //Fin del IF primero
		return redirect('galeria/' . $id_categoria);
	}

	public function verImagen($id) {
		$img = new Imagen();
		$imagen = $img->unaImagen($id);

		$rec = new Recorte();
		$recortes = $rec->recortesDeUnaImagen($id);

		$log = LogsMio::select('logs.updated_at', 'users.name', 'acciones.descripcion')
			->where('id_imagen', $id)
			->orWhere('id_accion', 3)
			->join('users', 'users.id', '=', 'logs.id_user')
			->join('acciones', 'acciones.id', '=', 'logs.id_accion')
			->get();
		///dd($log);

		$imagen[0]->log = $log;

		return view('fototeca/verImagen', [
			"categorias" => $this->getCategories(),
			"categoriasSelect" => $this->getAllCategories(),
			"imagen" => $imagen[0],
			"tags" => Imagen::tags($id),
			"recortes" => $recortes,
			"cantidad_imagenes" => $this->imagen_espacio(),
			"prevSig" => $this->prevSig($id, $imagen[0]->id_categoria),
		]);
	}

	public function prevSig($id, $idCategoria) {
		$anterior = Imagen::prevSig($id, $idCategoria, 'desc')->get();
		$posterior = Imagen::prevSig($id, $idCategoria, 'asc')->get();
		$anterior = (count($anterior) > 0) ? $anterior[0]->id : 0;
		$posterior = (count($posterior) > 0) ? $posterior[0]->id : 0;
		return (object) array("anterior" => $anterior, "posterior" => $posterior);
	}

	public function descargarImagen($id, $imgORec, $posicion, $imgAgua, $opacacidad, $tamaño) {
		if ($imgORec == 1) {
			$img = new Recorte();
		} else {
			$img = new Imagen();
		}

		$url = $img->urlImg($id); //URL DONDE ESTA LA IMAGEN

		//$tamaño = 1 o 0.... 1 Tamaño web, 0 Tamaño Original o 2100px
		if (($tamaño == 1) && ($imgORec != 1)) {
			$uri = substr($url[0]->url, 0, -4) . '_we.jpg'; //Tamaño Web!!!!!!
		} else if (($tamaño == 0) && ($imgORec != 1)) {
			$uri = substr($url[0]->url, 0, -4) . '_gr.jpg'; //Tamaño grande!!!!!!
		} else {
			$uri = $url[0]->url; //DIRECCION DE RECORTE
		}

		$posiciones = ["top-left", "top", "top-right", "left", "center", "right", "bottom-left", "bottom", "bottom-right"];

		if (PHP_OS != 'WINNT') {
			//Temporal Linux
			$pathTmp = '/tmp/' . md5($url[0]->url) . '.jpg';
		} else {
			//Temporal Windows
			$pathTmp = sys_get_temp_dir() . '/' . md5($url[0]->url) . '.jpg';
		}

		$img = Image::make($uri)->encode('jpg');

		//puede descargar con imagen de agua
		if ($imgAgua > 0) {
			$logos = ["",
				"img/logoUnne.png",
				"img/logoUnneBlanco.png",
				"img/logoUnneDescripcion.png",
				"img/logoUnneNegro.png",
				"img/marcaAguaUnne1.png"];
			$imgAgu = Image::make(public_path($logos[$imgAgua]))->opacity($opacacidad);
			$imgAgu->resize(null, 70, function ($constraint) {
				$constraint->aspectRatio();
			});
			/*Inserta la imagen de agua en la foto*/
			$img->insert($imgAgu, $posiciones[$posicion], 10, 10);
		}

		$img->save($pathTmp);

		$idImagen = ($imgORec == '0') ? $id : Recorte::find($id)->id_imagen;
		$tablaLog = ($imgORec === '0') ? 'imagenes' : 'recortes';

		$imgDesc = LogsMio::insertLog(4, Auth::user()->id, $tablaLog, $idImagen);

		return response()->download($pathTmp);
	}

	//Vista de una galeria
	public function galeria($id) {
		$galeria = Categoria::find($id);
		$imagenesGaleria = Imagen::where('id_categoria', $id)->orderBy('id', 'desc')->paginate(12);

		return view('fototeca/vistaGaleria', ["categorias" => $this->getCategories(),
			"categoriasSelect" => $this->getAllCategories(),
			"galeria" => $imagenesGaleria,
			"nombreCategoria" => 'Galeria: ' . $galeria->categoria,
			"cantidad_imagenes" => $this->imagen_espacio()]);
		//return  view('fototeca/vistaGaleriaAjax',["galeria"=> $galeria->imagenesGaleria]);
	}

	public function destroy($id) {
		$imagen = Imagen::findOrFail($id);
		$imagen_recorte = Recorte::where('id_imagen', $id)->get();
		if (count($imagen_recorte) > 0) {
			foreach ($imagen_recorte as $k => $v) {
				//elimino las imagenes recortadas
				unlink($v->url);
			}
		}

		$id_categoria = $imagen->id_categoria;

		$url_img = substr($imagen->url, 0, -4);
		file_exists($url_img . '_th.jpg') ? unlink($url_img . '_th.jpg') : '';
		file_exists($url_img . '_we.jpg') ? unlink($url_img . '_we.jpg') : '';
		file_exists($url_img . '_gr.jpg') ? unlink($url_img . '_gr.jpg') : '';

		Session::flash('eliminacion_imagen', 'Se Elimino la Imagen: ' . $imagen->titulo);

		$imgTag = ImagenTag::where('id_imagen', $id)->delete();

		$imagen->delete();

		return redirect('galeria/' . $id_categoria);

	}

	public function search(request $r) {

		//$img = Imagen::titulo($r->buscar)->orderBy('id','desc')->paginate();

		$titulo = (empty($r->buscar)) ? "" : $r->buscar;
		$tag = $r->BTag;
		$desc = (empty($r->BDescripcion)) ? "" : $r->BDescripcion;
		$fecha = (empty($r->BFecha)) ? "" : $r->BFecha;
		$BN = ($r->cob_n === "true") ? (($r->BBlancoNegro === "true") ? 1 : 0) : '';
		$VH = ($r->cob_n === "true") ? (($r->BVerticalHorizontal === "true") ? 1 : 0) : '';
		//dd($tag);
		$img = Imagen::titulos($titulo)
			->descripcion($desc)
			->tags($tag)
			->fecha($fecha)
			->fotoColor($BN)
			->fotoOrientacion($VH)
			->get();
		//->toSql();

		/*return view('fototeca/vistaGaleria',["categorias" => $this->getCategories(),
			                                    "categoriasSelect" => $this->getAllCategories(),
			                                    "galeria"=> $img,
			                                    "nombreCategoria"=>'Busqueda: '.$r->buscar,
		*/

		return view('fototeca/vistaGaleriaAjax', ["galeria" => $img]);
	}

	public function edit($id) {
		$img = new Imagen();
		$imagen = $img->unaImagen($id);

		return view('fototeca/verImagenEditar', [
			"categorias" => $this->getCategories(),
			"categoriasSelect" => $this->getAllCategories(),
			"imagen" => $imagen[0],
			"tags" => Imagen::tags($id),
			"cantidad_imagenes" => $this->imagen_espacio(),
		]);
	}

	public function editSave(Request $r) {
		//Guardo en Base de datos!
		$imagen = Imagen::find($r->input("id_imagen"));

		$imagen->titulo = $r->input('titulo');
		$imagen->descripcion = $r->input('descripcion');
		$imagen->foto_color = (isset($r->cob_n) ? 1 : 0);
		$imagen->repositorio = (isset($r->repositorio) ? 1 : 0);
		$imagen->fecha = $r->input('fecha');
		$save = $imagen->save();

		$log = LogsMio::insertLog(3, auth()->user()->id, 'imagenes');

		if ($save && is_array($r->input('tags'))) {
			//Guardo los TAGS de la imagen
			foreach ($r->input('tags') as $Tk => $Tv) {
				$array = array('id_imagen' => $imagen->id,
					'id_tag' => $Tv);
				// 'id_users' => Auth::user()->id);
				ImagenTag::create($array);
				$log = LogsMio::insertLog(1, auth()->user()->id, 'tags');
			}
		}

		if ($save) {
			Session::flash('edit_imagen', 'Se Edito Correctamente');
		} else {
			Session::flash('edit_imagen', 'Ocurrio un error al editar la imagen.');
		}

		return redirect('verImagen/' . $imagen->id);
	}

	//////////////////////////////CATEGORIAS

	public function formCategoria() {
		return view('fototeca/formCategoria', ["categorias" => $this->getCategories(),
			"todasLasCategorias" => $this->getAllCategories()]);
	}

	//////////////CALCULA cantidad de imagenes, espacio en disco

	public function imagen_espacio() {

		$img = Imagen::count();
		$recortes = Recorte::count();
		if (PHP_OS != 'WINNT') {
			// Linux
			$espacioLibre = $this->dataSize(disk_free_space("/srv"));
			$espacioTotal = $this->dataSize(disk_total_space("/srv"));
		} else {
			// Windows
			$espacioLibre = $this->dataSize(disk_free_space("c:"));
			$espacioTotal = $this->dataSize(disk_total_space("c:"));
		}
		$porcentajeOcupado = ceil((($espacioTotal - $espacioLibre) * 100) / $espacioTotal);
		$porcentajeLibre = ceil(($espacioLibre * 100) / $espacioTotal) - 1;

		return [$img,
			$porcentajeOcupado,
			$porcentajeLibre,
			$espacioLibre,
			$espacioTotal,
			$recortes];
	}

	private function dataSize($bytes) {
		return number_format($bytes / 1024 / 1024 / 1024, 2);
	}

	/*RECORTE DE IMAGENES*/

	//Vista de la imagen para recortar!
	public function recortar($id) {
		$img = new Imagen();
		$img = $img->unaImagen($id)[0];

		return view('fototeca/recortar', ["cantidad_imagenes" => $this->imagen_espacio(),
			"img" => $img]);
	}

	public function recorte(Request $r) {
		//dd($r->src);
		$targ_w = $r->w;
		$targ_h = $r->h;
		$ruta = 'imagenes/recortes/' . md5(time()) . '.jpg';
		$path = public_path($ruta); // /var/ww.......

		$img = Image::make($r->src);

		$imgAguaCalculoWidht = $targ_w * 0.2;
		$imgAguaCalculoWidht = ($imgAguaCalculoWidht > 55) ? 55 : $imgAguaCalculoWidht;

		// crop image
		$img->crop($targ_w, $targ_h, $r->x, $r->y);

		$img->save($path); //Imagen Web

		$recorte = new Recorte();
		$recorte->id_imagen = $r->id;
		// $recorte->id_user = Auth::user()->id;
		$recorte->url = 'public/' . $ruta;
		$save = $recorte->save();

		return redirect('verImagen/' . $r->id);
	}

	//USUARIOS CAMBIO DE CLAVE
	public function modificarClaveUsuario() {
		return view('fototeca/modificarClaveUsuario');
	}

	public function modificarClave(Request $r) {
		$u = User::modificarClave($r->password, Auth::user()->id);
		if ($u) {
			Auth::logout();
		} else {
			$mensaje = 'Hubo un error al editar la clave, pruebe de nuevo';
			Session::flash('reinicio_clave', $mensaje);
		}
		return redirect('/');
	}

	public function listaUser() {
		$users = User::orderby('name', "asc")->get();
		return view("fototeca/listadoUser", ['users' => $users]);
	}

}