<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Usuario;

class UsuarioController extends Controller
{
    public function get_all()
    {
        $usuarios = Usuario::get()->toJson(JSON_PRETTY_PRINT);

        return response($usuarios, 200);
    }

    public function get($id)
    {
        if(Usuario::where('IdUsuario', $id)->exists())
        {
            $usuario = Usuario::where('IdUsuario', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($usuario, 200);
        }
        else
        {
            return response()->json(
                [
                    "message" => "usuario não encontrado."
                ],
                404);
        }
    }

    public function create(Request $request)
    {
        $usuario = new Usuario;
        $usuario->Email = $request->Email;
        $usuario->Senha = $request->Senha;
        $usuario->RA = $request->RA;
        $usuario->Nome = $request->Nome;
        $usuario->save();

        return response()->json([
            "message" => "usuario criado com sucesso."
        ], 201);
    }

    public function update(Request $request, $id)
    {
        if(Usuario::where('IdUsuario', $id)->exists())
        {
            $usuario = Usuario::find($id);
            $usuario->Email =   is_null($request->Email) ? $usuario->Email : $request->Email;
            $usuario->Senha =   is_null($request->Senha) ? $usuario->Senha : $request->Senha;
            $usuario->RA    =   is_null($request->RA)    ? $usuario->RA    : $request->RA;
            $usuario->Nome  =   is_null($request->Nome)  ? $usuario->Nome  : $request->Nome;
            $usuario->save();

            return response()->json(
                [
                    "message" => "usuario atualizado com sucesso."
                ],
                200);
        }
        else
        {
            return response()->json(
                [
                    "message" => "usuario não encontrado."
                ],
                404);
        }
    }

    public function delete($id)
    {
        if(Usuario::where('IdUsuario', $id)->exists())
        {
            $usuario = Usuario::find($id);
            $usuario->delete();

            return response()->json(
                [
                    "message" => "usuario excluido com sucesso."
                ],
                202);
        }
        else
        {
            return response()->json(
                [
                    "message" => "usuario não encontrado."
                ],
                404);
        }
    }

    public function validarEmail(Request $request){

        $pattern = '/^ra\d+@uem\.br$/';
        
        if(preg_match($pattern, $request->email)){
            return response()->json(
                [
                    "message" => "email validado com sucesso",
                    "success" => true
                ],
                200
            );
        } else {
            return response()->json(
                [
                    "message" => "email invalido",
                    "success" => false
                ],
                422
            );
        }
    }
}
