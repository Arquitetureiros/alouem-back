<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use App\Models\Usuario;
use App\Models\Moderador;

class Auth extends Controller
{

    public function login(Request $request){

        $usuario = Usuario::where('Email', $request->email)->where('Senha', $request->senha)->first();
        $moderador = Moderador::where('Email', $request->email)->where('Senha', $request->senha)->first();

        if($usuario || $moderador){
            $pessoa = $usuario ? $usuario : $moderador;
            $tipo = $usuario ? 'usuario' : 'moderador';
            $pessoa->tipo = $tipo;
            $pessoa->senha = null;

            $response = $this->makeJwt($pessoa, $tipo);
            return response()->json(
                [
                    "message" => "login realizado com sucesso",
                    "success" => true,
                    "jwt" => $response,
                    'usuario' => $pessoa,
                ],
                200
            );

        } else {
            return response()->json(
                [
                    "message" => "Email ou senha inválidos",
                    "success" => false
                ],
                401
            );
        }


    }

    private function makeJwt($usuario, $tipo){

        $key = 'alouem';

        $payload = [
            'id' => isset($usuario->IdUsuario) ? $usuario->IdUsuario : 'admin',
            'email' => isset($usuario->Email) ? $usuario->Email : $usuario->Email,
            'tipo' => $tipo
        ];

        return JWT::encode($payload, $key, 'HS256');
    }
}
