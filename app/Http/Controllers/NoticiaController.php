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
        Log::info('brought request from React:', [
            $request
        ]);
        
        $validatedRequest = $request->validate([
            'titulo' => 'required|string|max:150',
            'introduccion' => 'required|string|max:250',
            'descripcion' => 'required|string|max:250',
            'contenido' => 'required',
            'nudo' => 'required',
            'desenlace' => 'required',
            'autor' => 'required|string|max:45',
            'referencia' => 'required',
            'fecha_publicacion' => 'required|string|max:45',
            'multimedia' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'multimedia_introduccion' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
            'multimedia_nudo' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
            'multimedia_desenlace' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
            'id_categoria' => 'required|exists:categorias,id_categoria',
            'id_etiqueta' => 'required|exists:etiquetas,id_etiqueta',
            'id_usuario' => 'required|exists:users,id'
        ]);
        

        $path = $request->file('multimedia')->store('multimedia', 'public');
        $path_introduction = $request->file('multimedia_introduccion')->store('multimedia', 'public');
        $path_node = $request->file('multimedia_nudo')->store('multimedia', 'public');
        $path_conclusion = $request->file('multimedia_desenlace')->store('multimedia', 'public');

        $createdNews = Noticia::create([
            'titulo' => $validatedRequest['titulo'],
            'introduccion' => $validatedRequest['introduccion'],
            'descripcion' => $validatedRequest['descripcion'],
            'contenido' => $validatedRequest['contenido'],
            'nudo' => $validatedRequest['nudo'],
            'desenlace' => $validatedRequest['desenlace'],
            'autor' => $validatedRequest['autor'],
            'referencia' => $validatedRequest['referencia'],
            'fecha_publicacion' => $validatedRequest['fecha_publicacion'],
            'multimedia' => $path,
            'multimedia_introduccion' => $path_introduction,
            'multimedia_nudo' => $path_node,
            'multimedia_desenlace' => $path_conclusion,
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
            'introduccion' => 'sometimes|string|max:250',
            'descripcion' => 'sometimes|string|max:80',
            'contenido' => 'sometimes',
            'nudo' => 'sometimes',
            'desenlace' => 'sometimes',
            'autor' => 'sometimes|string|max:45',
            'referencia' => 'sometimes',
            'fecha_publicacion' => 'sometimes|string|max:45',
            'id_categoria' => 'sometimes|exists:categorias,id_categoria',
            'id_etiqueta' => 'sometimes|exists:etiquetas,id_etiqueta',
        ]);

        if ($request->hasFile('multimedia')) {
            $path = $request->file('multimedia')->store('multimedia', 'public');
            $validatedRequest['multimedia'] = $path;
        }

        if ($request->hasFile('multimedia_introduccion')) {
            $path = $request->file('multimedia_introduccion')->store('multimedia', 'public');
            $validatedRequest['multimedia_introduccion'] = $path;
        }

        if ($request->hasFile('multimedia_nudo')) {
            $path = $request->file('multimedia_nudo')->store('multimedia', 'public');
            $validatedRequest['multimedia_nudo'] = $path;
        }

        if ($request->hasFile('multimedia_desenlace')) {
            $path = $request->file('multimedia_desenlace')->store('multimedia', 'public');
            $validatedRequest['multimedia_desenlace'] = $path;
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
