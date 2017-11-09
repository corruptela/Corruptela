<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Painel\Party;
use App\Models\Painel\Country;
use App\Http\Requests\Painel\PartyFormRequest;

class PartidoController extends Controller
{
    //
    private $party;
    private $totalPage = 20;
    
    
    public function __construct(Party $party)
    {
        $this->party = $party;
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Listagem dos partidos';
        
        $parties = $this->party->paginate($this->totalPage);
        
        return view('painel.parties.index', compact('parties', 'title'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Cadastrar Novo Partido';
        
        
        //$categorys = party::pluck('name', 'id');
        //$categorys->prepend('Escolha a Categoria!', '');
        //dd($categorys);
        
        return view('painel.parties.create-edit', compact('title'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PartyFormRequest $request)
    {
        //Pega todos os dados que vem do formulário
        $dataForm = $request->all();
        
        $dataForm['active'] = ( !isset($dataForm['active']) ) ? 0 : 1;
        
        //Valida os dados
        //$this->validate($request, $this->party->rules);
        /*
         $messages = [
         'name.required' => 'O campo nome é de preenchimento obrigatório!',
         'number.numeric' => 'Precisa ser apenas números!',
         'number.required' => 'O campo número é de preenchimento obrigatório!',
         ];
         $validate = validator($dataForm, $this->party->rules, $messages);
         if( $validate->fails() ) {
         return redirect()
         ->route('partidos.create')
         ->withErrors($validate)
         ->withInput();
         }
         *
         */
        
        //Faz o cadastro
        $insert = $this->party->create($dataForm);
        
        if( $insert )
            return redirect()->route('partidos.index');
            else
                return redirect()->route('partidos.create');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $party = $this->party->find($id);
        
        $title = "Partido:{$party->id} {$party->name}";
        
        return view('painel.parties.show', compact('party', 'title'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Recupera o produto pelo seu id
        $party = $this->party->find($id);
        
        $title = "Editar Produto:{$party->id} {$party->name}";
        
       // $categorys = ['eletronicos', 'moveis', 'limpeza', 'banho'];
        
        return view('painel.parties.create-edit', compact('title', 'party'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PartyFormRequest $request, $id)
    {
        //Recupera todos os dados do formulário
        $dataForm = $request->all();
        
        //Recupera o item para editar
        $party = $this->party->find($id);
        
        //Verifica se o produto está ativado
        $dataForm['active'] = ( !isset($dataForm['active']) ) ? 0 : 1;
        
        //Altera os itens
        $update = $party->update($dataForm);
        
        //Verifica se realmente editou
        if( $update )
            return redirect()->route('partidos.index');
            else
                return redirect()->route('partidos.edit', $id)->with(['errors' => 'Falha ao editar']);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $party = $this->party->find($id);
        
        $delete = $party->delete();
        
        if( $delete )
            return redirect()->route('partidos.index');
            else
                return redirect()->route('partidos.show', $id)->with(['errors' => 'Falha ao deletar']);
    }
    
    public function autoComplete(Request $request) {
        $term=$request->term;

        $data = country::where('name','LIKE','%'.$term.'%')
                ->take(10)
                ->get();

        $result=array();

        foreach ($data as $key => $v){
            $result[]=['value' =>$value->id];
        }
        
        return response()->json($results);
       
    }
    
    public function search(Request $request)
    {
        //Pega os dados do formulário
        $dataForm = $request->except('_token');
        $keySearch = $dataForm['search'];
        
        //Título da página
        $title = "Resultados para partido: {$keySearch}";
        
        //Faz o filtro dos dados
        $parties = $this->party
        ->where('name', 'LIKE', "%$keySearch%")
        ->orWhere('initials', 'LIKE', "%$keySearch%")
        ->paginate($this->totalPage);
        
        return view('painel.parties.index', compact('parties', 'title', 'dataForm'));
    }
    
}
