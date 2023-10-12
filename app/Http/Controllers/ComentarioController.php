<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Comentario;

class ComentarioController extends Controller
{
    public function get_all()
    {
        $comentarios = Comentario::get()->toJson(JSON_PRETTY_PRINT);

        return response($comentarios, 200);
    }

    public function get($id)
    {
        if(Comentario::where('IdComentario', $id)->exists())
        {
            $comentario = Comentario::where('IdComentario', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($comentario, 200);
        }
        else
        {
            return response()->json(
                [
                    "message" => "comentario não encontrado."
                ],
                404);
        }
    }

    public function get_publicacao($id)
    {
        if(Comentario::where('fk_IdPublicacao', $id)->exists())
        {
            $comentarios = Comentario::where('fk_IdPublicacao', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($comentarios, 200);
        }
        else
        {
            return response()->json(
                [
                    "message" => "comentario não encontrado."
                ],
                404);
        }
    }

    public function create(Request $request)
    {
        $comentario = new Comentario;
        $comentario->fk_IdPublicacao = $request->fk_IdPublicacao;
        $comentario->fk_IdUsuario = $request->fk_IdUsuario;
        $comentario->NomeUsuario = $request->NomeUsuario;
        $comentario->Descricao = $request->Descricao;
        $comentario->save();

        return response()->json([
            "message" => "comentario criado com sucesso."
        ], 201);
    }

    public function update(Request $request, $id)
    {
        if(Comentario::where('IdComentario', $id)->exists())
        {
            $comentario = Comentario::find($id);
            $comentario->fk_IdPublicacao =   is_null($request->fk_IdPublicacao) ? $comentario->fk_IdPublicacao : $request->fk_IdPublicacao;
            $comentario->fk_IdUsuario =   is_null($request->fk_IdUsuario) ? $comentario->fk_IdUsuario : $request->fk_IdUsuario;
            $comentario->NomeUsuario    =   is_null($request->NomeUsuario)    ? $comentario->NomeUsuario    : $request->NomeUsuario;
            $comentario->Descricao  =   is_null($request->Descricao)  ? $comentario->Descricao  : $request->NomDescricaoe;
            $comentario->save();

            return response()->json(
                [
                    "message" => "comentario atualizado com sucesso."
                ],
                200);
        }
        else
        {
            return response()->json(
                [
                    "message" => "comentario não encontrado."
                ],
                404);
        }
    }

    public function delete($id)
    {
        if(Comentario::where('IdComentario', $id)->exists())
        {
            $comentario = Comentario::find($id);
            $comentario->delete();

            return response()->json(
                [
                    "message" => "comentario excluido com sucesso."
                ],
                202);
        }
        else
        {
            return response()->json(
                [
                    "message" => "comentario não encontrado."
                ],
                404);
        }
    }
}
