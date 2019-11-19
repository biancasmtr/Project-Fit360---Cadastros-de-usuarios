<?php

namespace App\Http\Controllers\Admin;

use App\Empresa;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Empresas;
use Illuminate\Validation\Rule;
use Illuminate\Database\QueryException;
use DB;

class EmpresasController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $listaMigalhas = json_encode([
            ["titulo"=>"Home","url"=>route('home')],
            ["titulo"=>"Lista de Empresas","url"=>""]
        ]);

        $listaModelo = Empresa::with('usuarios')->get();
        //$listaEmpresa = DB::table('empresas')->get(); 'listaEmpresa'=> $listaEmpresa

        return view('admin.empresas.index',['listaMigalhas' => $listaMigalhas,'listaModelo' => $listaModelo,]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validacao = \Validator::make($data, [
            "razao_social" => "required",
            "endereco" => "required",
            $this->validate($request, [
                'cnpj' => 'required|cnpj',
                'unique:empresas'
            ]),
            "telefone" => "required"
        ]);

        if($validacao->fails()){
            return redirect()->back()->withErrors($validacao)->withInput();
        }

        Empresa::create($data);
        
        return redirect()
        ->back()
        ->with('success','Empresa Cadastrada com sucesso!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_empresa)
    {
        $data = $request->all();

        $validacao = \Validator::make($data, [
            'razao_social' => ['required', 'string', 'max:255'],
            'endereco' => ['string', 'max:255'],
            $this->validate($request, [
                'cnpj' => 'required|cnpj',
                'unique:empresas'
            ]),
            'telefone' => ['min:10']
        ]);

        if($validacao->fails()){
            return redirect()->back()->withErrors($validacao)->withInput();
        }

        Empresa::find($id_empresa)->update($data);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_empresa)
    {   
        try {
            /*DB::table("empresas")->delete($id_empresa);
            return response()->json(['success'=>"Empresa Deletada com Sucesso!."]);*/
            Empresa::find($id_empresa)->forceDelete();
            flash('Empresa excluída com sucesso!')->success();
        } catch (QueryException $e) {
            flash()->error('Essa empresa não pode ser excluída por conter usuários cadastrados nela!');
            return redirect()->back();
        }
        return redirect()->back();
    }
}
