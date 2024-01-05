<?php

namespace App\Http\Middleware;

use Closure;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class checkauth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        // print_r($request->header());
        $token = $request->header('authorization');
        $arreglo_token = explode(" ", $token);
       
        $arreglo_error = [
            "error" => "403",
            "message" => "Acceso Denegado"
        ];

        if($arreglo_token[0] == "Bearer"){
            $key = 'palabra_secreta';

            try {
                //code...
                if(JWT::decode($arreglo_token[1], new Key($key, 'HS256'))){
                    return $next($request);
                }
            } catch (\Throwable $th) {
                //throw $th;
                return response()->json($arreglo_error);
            }

            
        }
        return response()->json($arreglo_error);
    }
}
