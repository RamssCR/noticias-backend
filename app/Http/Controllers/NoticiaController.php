<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Noticia;
use Illuminate\Support\Facades\Log;

class NoticiaController extends Controller
{
    // Show all approved news
    public function index() {
        $news = Noticia::where('estatus', 1)->where('deshabilitado', 0)->get();
        return response()->json($news);
    }

    // Show all news (regardless of them being approved, rejected or in review)
    public function all() {
        $news = Noticia::where('deshabilitado', 0)->get();
        return response()->json($news);
    }

    // Show a selected news
    public function show($id) {
        $chosenNews = Noticia::where('id_noticias', $id)->get();
        return response()->json($chosenNews);
    }

    // Create a news
    public function create(Request $request) {       
        $validatedRequest = $request->validate([
            'titulo' => 'required|string|max:150',
            'descripcion' => 'required|string|max:80',
            'contenido' => 'required',
            'autor' => 'required|string|max:45',
            'fecha_publicacion' => 'required|string|max:45',
            'multimedia' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'id_categoria' => 'required|exists:categorias,id_categoria',
            'id_etiqueta' => 'required|exists:etiquetas,id_etiqueta',
            'id_usuario' => 'required|exists:users,id'
        ]);
        

        $path = $request->file('multimedia')->store('multimedia', 'public');

        $createdNews = Noticia::create([
            'titulo' => $validatedRequest['titulo'],
            'descripcion' => $validatedRequest['descripcion'],
            'contenido' => $validatedRequest['contenido'],
            'autor' => $validatedRequest['autor'],
            'fecha_publicacion' => $validatedRequest['fecha_publicacion'],
            'multimedia' => $path,
            'id_categoria' => $validatedRequest['id_categoria'],
            'id_etiqueta' => $validatedRequest['id_etiqueta'],
            'id_usuario' => $validatedRequest['id_usuario']
        ]);

        return response()->json($createdNews);
    }

    // Modify a news information
    public function update($id, Request $request) {
        $foundNews = Noticia::find($id);

        $validatedRequest = $request->validate([
            'titulo' => 'sometimes|string|max:150',
            'descripcion' => 'sometimes|string|max:80',
            'contenido' => 'sometimes',
            'autor' => 'sometimes|string|max:45',
            'fecha_publicacion' => 'sometimes|string|max:45',
            'id_categoria' => 'sometimes|exists:categorias,id_categoria',
            'id_etiqueta' => 'sometimes|exists:etiquetas,id_etiqueta',
        ]);

        if ($request->hasFile('multimedia')) {
            $path = $request->file('multimedia')->store('multimedia', 'public');
            $validatedRequest['multimedia'] = $path;
        }

        $foundNews->update($validatedRequest);
        return response()->json($foundNews);
    }

    // Approve or reject a news
    public function review($id, Request $request) {
        $foundNews = Noticia::find($id);
        $validatedStatus = $request->validate(['estatus' => 'required|in:0,1,2']);

        $foundNews->estatus = $validatedStatus['estatus'];
        $foundNews->save();

        return response()->json(['message' => 'Noticia revisada exitosamente']);
    }

    // Delete a news
    public function destroy($id) {
        $foundNews = Noticia::find($id);
        $foundNews->deshabilitado = 1;
        $foundNews->save();

        return response()->json(['message' => 'Noticia eliminada exitosamente']);
    }
}
