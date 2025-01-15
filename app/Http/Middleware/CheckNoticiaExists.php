<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Noticia;

class CheckNoticiaExists
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $idNews = $request->route('id');
        if ($idNews && Is_numeric($idNews)) {
            if (!Noticia::find($idNews) || Noticia::where('id_noticias', $idNews)->where('deshabilitado', 1)->exists()) {
                return response()->json(['message' => 'news not found'], 400);
            }
        }

        return $next($request);
    }
}
