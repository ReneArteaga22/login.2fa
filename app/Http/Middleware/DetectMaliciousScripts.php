<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DetectMaliciousScripts
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Excluir rutas de autenticación y archivos estáticos
        if ($request->is('login*', 'register*', 'verify*', 'css/*', 'js/*', 'images/*')) {
            return $next($request);
        }
    
        $maliciousPatterns = [
            '<script>', 'javascript:', 'onerror=', 'onload=', 'alert(',
            'document.cookie', '<iframe>', '</iframe>', 'eval('
        ];
    
        $path = urldecode($request->path());
        $queryString = urldecode($request->getQueryString() ?? '');
    
        foreach ($maliciousPatterns as $pattern) {
            if (stripos($path, $pattern) !== false || 
                ($queryString && stripos($queryString, $pattern) !== false)) {
                Log::warning('Intento de ataque detectado', [
                    'path' => $path,
                    'query' => $queryString,
                    'ip' => $request->ip()
                ]);
                abort(403, 'Solicitud bloqueada por seguridad');
            }
        }
    
        return $next($request);
    }
}
