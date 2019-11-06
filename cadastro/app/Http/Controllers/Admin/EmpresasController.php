<?php



namespace App\Http\Controllers\Admin;

use App\Empresa;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class EmpresasController extends Controller
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
            ["titulo"=>"Lista de Empresas","url"=>""]
        ]);

        $listaModelo = Empresa::all('id_empresa','razao_social','endereco','cnpj','telefone');

        /* PRECISO ARRUMAR UM JEITO DE COLOCAR O ID_EMPRESA DINAMICAMENTE NESTE FIND D: */
        
        $usuarios = Empresa::find(1)->usuarios;
        //$usuarios = Empresa::with('user')->get();
        //$usuarios = Empresa::find(1)->get();

        return view('admin.empresas.index',['listaMigalhas' => $listaMigalhas,'listaModelo' => $listaModelo,'usuarios' => $usuarios]);
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
            "cnpj" => "required",
            "telefone" => "required"
        ]);

        if($validacao->fails()){
            return redirect()->back()->withErrors($validacao)->withInput();
        }

        Empresa::create($data);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$usuarios = User::find("id_empresa=1");
        $usuarios = Empresa::find($id)->usuarios;
        return view('admin.empresas.index',['usuarios' => $usuarios]);

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
            'cnpj' => ['required', 'min:11'],
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
        Empresa::find($id_empresa)->delete();
        return redirect()->back();
    }
}
