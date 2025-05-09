<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = Http::get('https://jsonplaceholder.typicode.com/posts');
        return $response->json();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $response = Http::post('https://jsonplaceholder.typicode.com/posts', $request);
        return $response->json();

        //EJEMPLOS DEVOLVER RESPUESTA

        //return "Post creado correctamente";
        //return ['mensaje'] => 'Post creado correctamente'];
        //return response()->json(['mensaje' => 'Post creado correctamente']);
        //return response()->json(['mensaje' => 'Post creado correctamente'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $response = Http::get('https://jsonplaceholder.typicode.com/posts/' . $id);
        return $response->json();

        //EJEMPLOS DEVOLVER RESPUESTA
        //$data = $response->json();
        //return ['title' => $data['title']];  Para devolver solo el título
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $response = Http::put('https://jsonplaceholder.typicode.com/posts/'.$id,$request);
        // $response = Http::patch('https://jsonplaceholder.typicode.com/posts/'.$id,$request);
        return $response->json();   

        //Buena Practica es enviar todos los parametros en PUT. y si solo queremos actualizar uno solo, lo enviamos en el PATCH
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $response = Http::delete('https://jsonplaceholder.typicode.com/posts/'.$id);
        if ($response->status() !== 200) {
            return response()->json(['error' => 'No se pudo eliminar el post'], 500);
        }
        return ['mensaje' => 'Post eliminado correctamente'];

        
    }


    public function filteringResource(String $id)
    {
        $reposnse = Http::get('https://jsonplaceholder.typicode.com/posts?userId='.$id);
        return $reposnse->json();
    }



    public function ListingNestedResources(String $id)
    {
        $reposnse = Http::get("https://jsonplaceholder.typicode.com/posts/$id/comments");
        return $reposnse->json();
    }
}
