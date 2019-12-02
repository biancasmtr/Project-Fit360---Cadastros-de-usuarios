<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listaMigalhas = json_encode([
            ["titulo"=>"Home","url"=>route('home')],
            ["titulo"=>"Lista de Usuários","url"=>""]
        ]);

        $listaModelo = DB::table('users')->paginate(100)->onEachSide(1);

        foreach ($listaModelo as $key => $value) {
           $value->id_empresa = \App\Empresa::find($value->id_empresa)->razao_social;
        }

        return view('admin.usuarios.index',compact('listaMigalhas','listaModelo'));

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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'id_empresa' => ['required'],
        ]);

        if($validacao->fails()){
            return redirect()->back()->withErrors($validacao)->withInput();
        }

        $data['password'] = bcrypt($data['password']);

        User::create($data);

        return redirect()
        ->back()
        ->with('success','Usuário Cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return User::find($id);
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
    public function update(Request $request, $id)
    {
        $data = $request->all();
        
        /* atualizar senha */
        if (isset($data['password']) && $data['password'] != "") {
            
            $validacao = \Validator::make($data, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($id)],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'id_empresa' => ['required', 'string']
            ]);
            $data['password'] = bcrypt($data['password']);
        } else {
            $validacao = \Validator::make($data, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($id)],
                
            ]);
            unset($data['password']);
        }
        /* fim atualizar senha */

        if($validacao->fails()){
            return redirect()->back()->withErrors($validacao)->withInput();
        }

        User::find($id)->update($data);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            User::find($id)->forceDelete();
            flash('Usuário excluído com sucesso!')->success();
        } catch (QueryException $e) {
            flash()->error('Erro ao excluir usuário');
            return redirect()->back();
        }
        return redirect()->back();
    }
}
