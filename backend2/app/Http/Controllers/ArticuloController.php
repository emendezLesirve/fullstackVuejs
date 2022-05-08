<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Articulo;
use DB;



class ArticuloController extends Controller
{

    public function articles()
    {

    // return Articulo::all();
    // return $articulo;

      $articulo = new Articulo();
       $articulo = DB::select(
          'SELECT a.idarticulo,a.nombre,c.nombre as categoria,a.precio,a.descripcion 
           FROM articulos as a 
           INNER JOIN categorias as c ON(a.idcategoria=c.idcategoria)
           '
        );
        return $articulo;
        
   /*    $articulo= Articulo::all(); 
    

       return response()->json([
           'articles'=>$articulo,
           'messages'=>'Articulos',
           'code'=>200
       ]);*/

       
    }  

    public function show(Articulo $articulo)
    {
        return $articulo;
    }

    public function store(Request $request)
    {

        $article=new Articulo();
        $article->nombre=$request->nombre;
        $article->idcategoria=$request->idcategoria;
        $article->descripcion=$request->descripcion;
        $article->precio=$request->precio;
        $article->save();

        return response()->json([
            'messages'=>'Article Created Successfully',
            'code'=>200
        ]);

        /*
        $articulo = Articulo::create($request->all());

        return response()->json($articulo, 201);*/
    }

    public function update(Request $request,$id)
    {

        $article =Articulo::where('idarticulo',$id)->first();
        $article->idcategoria=$request->idcategoria;
        $article->nombre=$request->nombre;
        $article->precio=$request->precio;
        $article->descripcion=$request->descripcion;
      //  $article->imagen=$request->imagen;
      $article->save();

      return response()->json([
          'messages'=>'Article Updated Successfully',
          'code'=>200
      ]);

       /* $articulo->update($request->all());

        return response()->json($articulo, 200);*/
    }

    public function delete($id)
    {

        $article=Articulo::find($id);
        if($article){
            $article->delete();
            return response()->json([
                'messages'=>'Contact Deleted Successfully',
                'code'=>200
            ]);
        }else{
            return response()->json([
               'message'=>"Contact with $id dos not exists"
            ]);
        }
        
          

      /*  $articulo->delete();

        return response()->json(null, 204);*/
    }
}


