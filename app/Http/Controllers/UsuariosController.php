<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Support\Facades\Hash;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function register( Request $request )
    {
        // Registra un usuario

        $request->validate([
            "name" => "required",
            "email" => 'required|email|unique:users',
            'password'=> 'required|confirmed',
        ]);

        $user = new User();
        $user->email = $request->email; //remember_token
        $user->name = $request->name; //
        $user->password = Hash::make($request->password);
        $user->save();

        return response($user);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
     
        // obtener email y password
        $credentials = request()->only('email', 'password');
        // validar correo y password
        
        if(Auth::attempt($credentials)){


            // Si existe el usuario consulta sus datos en la BD para generar el token con id
            $user = Auth::user();
            // $user = User::where('email', $credentials['email'])->first();
            
            
            // Si los datos con correctos retorna el JWT
            // calcula el tiempo actual
            $now = strtotime("now");
            // palabra secreta debe ir en .env
            $key = 'palabra_secreta';
            //datos a encriptar
            $payload = [
                'exp' => $now + 3600,
                'data' => $user->id     // id del usuario logueado
                
            ];
            // genera el JWT
            $jwt = JWT::encode($payload, $key, 'HS256');


            

            return response()->json(['token' => $jwt]);

        }else{
           return print_r("Login error");

        }

       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function profile(Request $request)
    {
        // CONSULTA LOS DATOS DEL PERFIL DEL USUARIO
        // Si existe el usuario consulta sus datos en la BD

    
        $token = $request->header('authorization');
        $arreglo_token = explode(" ", $token);
       
        $key = 'palabra_secreta';

        $tokenId = JWT::decode($arreglo_token[1], new Key($key, 'HS256'));
        $id = $tokenId->data;
        $user = User::where('id', $id)->first();

        return response()->json($user);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {

     
        // elimina la sesion
       
        Auth::logout();

        return response()->json(['message' => 'Sesion Cerrada']);


    }
}
