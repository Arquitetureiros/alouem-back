<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Foto;

class FotoController extends Controller
{
    public function get_all()
    {
        $fotos = Foto::get()->toJson(JSON_PRETTY_PRINT);

        return response($fotos, 200);
    }

    public function get($id)
    {
        if(Foto::where('IdFoto', $id)->exists())
        {
            $foto = Foto::where('IdFoto', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($foto, 200);
        }
        else
        {
            return response()->json(
                [
                    "message" => "foto não encontrada."
                ],
                404);
        }
    }

    public function create(Request $request)
    {
        $foto = new Foto;
        $foto->nome             = $request->nome;
        $foto->fk_IdPublicacao  = $request->fk_IdPublicacao;
        $foto->save();

        return response()->json([
            "message" => "foto criada com sucesso."
        ], 201);
    }

    public function update(Request $request, $id)
    {
        if(Foto::where('IdFoto', $id)->exists())
        {
            $foto = Foto::find($id);
            $foto->nome =   is_null($request->nome) ? $foto->nome : $request->nome;
            $foto->fk_IdPublicacao =   is_null($request->fk_IdPublicacao) ? $foto->fk_IdPublicacao : $request->fk_IdPublicacao;
            $foto->save();

            return response()->json(
                [
                    "message" => "foto atualizada com sucesso."
                ],
                200);
        }
        else
        {
            return response()->json(
                [
                    "message" => "foto não encontrada."
                ],
                404);
        }
    }

    public function delete($id)
    {
        if(Foto::where('IdFoto', $id)->exists())
        {
            $foto = Foto::find($id);
            $foto->delete();

            return response()->json(
                [
                    "message" => "foto excluida com sucesso."
                ],
                202);
        }
        else
        {
            return response()->json(
                [
                    "message" => "foto não encontrada."
                ],
                404);
        }
    }
}
