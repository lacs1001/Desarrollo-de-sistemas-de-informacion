<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\v1\Producto;

use Illuminate\Support\Facades\Storage;


class ProductosController extends Controller
{
    function getAll(Request $request)
    {
        $search=$request->search;

        if(!$search)
        {
            $search="%";
        }

        $response= new \stdClass();
        
        $productos = Producto::where("codigo","like","%".$search."%")
        ->orWhere("nombre","like","%".$search."%")
        ->orWhere("categoria","like","%".$search."%")
        ->get();
    
        $response->success=true;
        $response->data = $productos;

        return response()->json($response,200);
    }

    function getItem($id)
    {
        $response= new \stdClass();
        $producto = Producto::find($id);

        if(!$producto)
        {
            $response->success=false;
            $response->errors=["el producto con el id ".$id." no existe"];
        }
        else
        {
            $response->success=true;
            $response->data = $producto;
        }

        return response()->json($response,($response->success?200:400));
    }

    function store(Request $request)
    {
        $response= new \stdClass();
        $response->success=true;
        $response_code=200;

        $errors=[];

        $producto = new Producto();

        $producto->codigo = $request->codigo;
        if(!$request->codigo)
        {
            $response->success=false;
            $errors[]="Necesita ingresar el código";
            $response_code=400;
        }
        
        $producto->nombre = $request->nombre;
        if(!$request->nombre)
        {
            $response->success=false;
            $errors[]="Necesita ingresar el nombre";
            $response_code=400;
        }

        if($request->imagen)
        {
            $file_content=base64_decode($request->imagen["data"]);

            file_put_contents(base_path()."/../public_html/images/".$request->imagen["nombre"],$file_content);


            $producto->ruta_imagen="/images/".$request->imagen["nombre"];

            //return $request->imagen["data"];
        }
        
        $producto->categoria = $request->categoria;
        $producto->precio = $request->precio;

        if($response->success)
        {
            $producto_db=Producto::where("codigo","=",$request->codigo)
            ->orWhere("nombre","=",$request->nombre)
            ->first();

            if(!$producto_db)
            {
                $producto->save();
                $response->data = $producto;
            }
            else
            {
                $response->success=false;
                $response_code=400;
                if($producto_db->codigo==$request->codigo)
                {
                    $errors[]="Ya existe un producto con el código ".$request->codigo;
                    
                }
                if($producto_db->nombre==$request->nombre)
                {
                    $errors[]="Ya existe un producto con el nombre ".$request->nombre;
                }
                
            }

            
        }
        
        if(!$response->success)
        $response->errors=$errors;
        
        
        return response()->json($response,$response_code);   
    }

    function putUpdate(Request $request)
    {
        $response= new \stdClass();

        $producto=Producto::find($request->id);

        if($producto)
        {
            $producto->codigo = $request->codigo;
            $producto->nombre = $request->nombre;
            $producto->categoria = $request->categoria;
            $producto->precio = $request->precio;
            $producto->save();

            $response->success=true;
            $response->data = $producto;
        }
        else
        {
            $response->success=false;
            $response->erros=["el producto con el id ".$request->id." no existe"];
        }

        
        return response()->json($response,($response->success?200:401));

    }

    function patchUpdate(Request $request)
    {
        $response= new \stdClass();

        $producto=Producto::find($request->id);

        if($producto)
        {
            if($request->codigo)
            $producto->codigo = $request->codigo;

            if($request->nombre)
            $producto->nombre = $request->nombre;

            if($request->categoria)
            $producto->categoria = $request->categoria;

            if($request->precio)
            $producto->precio = $request->precio;

            $producto->save();

            $response->success=true;
            $response->data = $producto;
        }
        else
        {
            $response->success=false;
            $response->erros=["el producto con el id ".$request->id." no existe"];
        }

        
        return response()->json($response,($response->success?200:401));



    }

    function delete($id)
    {
        $response= new \stdClass();

        $producto=Producto::find($id);

        if($producto)
        {
            $producto->delete();
            $response->success=true;
        }
        else
        {
            $response->success=false;
            $response->erros=["el producto con el id ".$id." no existe"];
        }

        return response()->json($response,($response->success?200:401));
    }
}
