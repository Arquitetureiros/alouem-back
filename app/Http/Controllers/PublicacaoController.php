<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Publicacao;

class PublicacaoController extends Controller
{
    public function get_all()
    {
        $publicacoes = Publicacao::with(['comentarios'])
        ->with(['fotos'])
        ->get()
        ->toJson(JSON_PRETTY_PRINT);

        return response($publicacoes, 200);
    }

    public function get($id)
    {
        if(Publicacao::where('IdPublicacao', $id)->exists())
        {
            $publicacao = Publicacao::where('IdPublicacao', $id)
            ->with(['comentarios'])
            ->with(['fotos'])
            ->first()->toJson(JSON_PRETTY_PRINT);
            return response($publicacao, 200);
        }
        else
        {
            return response()->json(
                [
                    "message" => "publicacao não encontrada."
                ],
                404);
        }
    }

    public function get_usuario($id)
    {
        if(Publicacao::where('fk_IdUsuario', $id)->exists())
        {
            $publicacoes = Publicacao::where('fk_IdUsuario', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($publicacoes, 200);
        }
        else
        {
            return response()->json(
                [
                    "message" => "publicacao não encontrada."
                ],
                404);
        }
    }

    public function create(Request $request)
    {
        $publicacao = new Publicacao;
        $publicacao->Titulo         = $request->Titulo;
        $publicacao->descricao      = $request->descricao;
        $publicacao->Endereco      = $request->Endereco;
        $publicacao->fk_IdEstado       = $request->fk_IdEstado;
        $publicacao->VotosPositivos = $request->VotosPositivos;
        $publicacao->VotosNegativos = $request->VotosNegativos;
        $publicacao->fk_IdUsuario      = $request->fk_IdUsuario;
        $publicacao->save();

        return response()->json([
            "id" => $publicacao->IdPublicacao,
            "message" => "publicacão criada com sucesso."
        ], 201);
    }

    public function update(Request $request, $id)
    {
        if(Publicacao::where('IdPublicacao', $id)->exists())
        {
            $publicacao = Publicacao::find($id);
            $publicacao->Titulo =   is_null($request->Titulo) ? $publicacao->Titulo : $request->Titulo;
            $publicacao->descricao =   is_null($request->descricao) ? $publicacao->descricao : $request->descricao;
            $publicacao->Endereco =   is_null($request->Endereco) ? $publicacao->Endereco : $request->Endereco;
            $publicacao->fk_IdEstado    =   is_null($request->fk_IdEstado)    ? $publicacao->fk_IdEstado    : $request->fk_IdEstado;
            $publicacao->VotosPositivos  =   is_null($request->VotosPositivos)  ? $publicacao->VotosPositivos  : $request->VotosPositivos;
            $publicacao->VotosNegativos  =   is_null($request->VotosNegativos)  ? $publicacao->VotosNegativos  : $request->VotosNegativos;
            $publicacao->fk_IdUsuario  =   is_null($request->fk_IdUsuario)  ? $publicacao->fk_IdUsuario  : $request->fk_IdUsuario;
            $publicacao->save();

            return response()->json(
                [
                    "message" => "publicacao atualizada com sucesso."
                ],
                200);
        }
        else
        {
            return response()->json(
                [
                    "message" => "publicacao não encontrada."
                ],
                404);
        }
    }

    public function delete($id)
    {
        if(Publicacao::where('IdPublicacao', $id)->exists())
        {
            $publicacao = Publicacao::find($id);
            $publicacao->delete();

            return response()->json(
                [
                    "message" => "publicacao excluida com sucesso."
                ],
                202);
        }
        else
        {
            return response()->json(
                [
                    "message" => "publicacao não encontrada."
                ],
                404);
        }
    }

    public function getRevisao(){

        $publicacoes = Publicacao::where('fk_IdEstado', '3')->get();

        return response()->json(
            [
                'data' => $publicacoes,
            ], 200
        );
    }
}
