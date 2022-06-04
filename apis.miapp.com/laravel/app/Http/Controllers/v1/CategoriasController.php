<?php
 
namespace App\Http\Controllers\v1;
 
use App\Http\Controllers\Controller;

use App\Models\v1\Categoria;

use Illuminate\Http\Request;

 
class CategoriasController extends Controller
{

    function obtenerListado()
    {
        $arr=[];
        $arr["uno"]=1;
        $arr["dos"]=1;

        return $arr;

        $response = new \stdClass();
        $response->success = true;

        $categorias = Categoria::all();

        
        $response->data=$categorias;

        return response()->json($response,200);

    }

    function obtenerElemento($id)
    {
        $response = new \stdClass();
        $response->success = true;

        $categoria=Categoria::find($id);


        $response->data=$categoria;

        return response()->json($response,200);

    }


    function guardar(Request $request)
    {
        $response = new \stdClass();
        $response->success = true;

        $categoria = new Categoria();
        $categoria->codigo=$request->codigo;
        $categoria->nombre = $request->nombre;
        $categoria->save();

        $response->data =$categoria;

        response()->json($response,200);
    }

    function editarPut(Request $request)
    {
        $response = new \stdClass();
        $response->success = true;


        $categoria = Categoria::find($request->id);

        $categoria->codigo=$request->codigo;
        $categoria->nombre=$request->nombre;
        $categoria->save();

        $response->data=$categoria;

        return response()->json($response,200);

    }

    function editarPatch(Request $request)
    {
        $response = new \stdClass();
        $response->success = true;


        $categoria = Categoria::find($request->id);

        if($request->codigo)
            $categoria->codigo=$request->codigo;
        
        if($request->nombre)
            $categoria->nombre=$request->nombre;
        
        $categoria->save();

        $response->data = $categoria;

        return response()->json($response,200);

    }



    function eliminar($id)
    {
        $response = new \stdClass();
        $response->success = true;

        $categoria = Categoria::find($id);
        $categoria->delete();

        return response()->json($response,200);
    }

}