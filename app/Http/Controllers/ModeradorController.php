<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Moderador;

class ModeradorController extends Controller
{
    public function get_all()
    {
        $moderadores = Moderador::get()->toJson(JSON_PRETTY_PRINT);

        return response($moderadores, 200);
    }

    public function get($email)
    {
        if(Moderador::where('Email', $email)->exists())
        {
            $moderador = Moderador::where('Email', $email)->get()->toJson(JSON_PRETTY_PRINT);
            return response($moderador, 200);
        }
        else
        {
            return response()->json(
                [
                    "message" => "moderador não encontrado."
                ],
                404);
        }
    }

    public function create(Request $request)
    {
        $moderador = new Moderador;
        $moderador->Email = $request->Email;
        $moderador->Senha = $request->Senha;
        $moderador->save();

        return response()->json([
            "message" => "moderador criado com sucesso."
        ], 201);
    }

    public function update(Request $request, $email)
    {
        if(Moderador::where('Email', $email)->exists())
        {
            $moderador = Moderador::find($email);
            $moderador->Email =   is_null($request->Email) ? $moderador->Email : $request->Email;
            $moderador->Senha =   is_null($request->Senha) ? $moderador->Senha : $request->Senha;
            $moderador->save();

            return response()->json(
                [
                    "message" => "moderador atualizado com sucesso."
                ],
                200);
        }
        else
        {
            return response()->json(
                [
                    "message" => "moderador não encontrado."
                ],
                404);
        }
    }

    public function delete($email)
    {
        if(Moderador::where('Email', $email)->exists())
        {
            $moderador = Moderador::find($email);
            $moderador->delete();

            return response()->json(
                [
                    "message" => "moderador excluido com sucesso."
                ],
                202);
        }
        else
        {
            return response()->json(
                [
                    "message" => "moderador não encontrado."
                ],
                404);
        }
    }
}
