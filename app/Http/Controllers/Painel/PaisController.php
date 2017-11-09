<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Painel\Country;
use App\Http\Requests\Painel\CountryFormRequest;

class PaisController extends Controller
{
    private $country;
    private $totalPage = 20;
    
    
    public function __construct(country $country)
    {
        $this->country = $country;
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Listagem dos Países';
        
        $countries = $this->country->paginate($this->totalPage);
        
        return view('painel.countries.index', compact('countries', 'title'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Cadastrar Novo Países';
        
        
        //$categorys = country::pluck('name', 'id');
        //$categorys->prepend('Escolha a Categoria!', '');
        //dd($categorys);
        
        return view('painel.countries.create-edit', compact('title'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(countryFormRequest $request)
    {
        //Pega todos os dados que vem do formulário
        $dataForm = $request->all();
        
        $dataForm['active'] = ( !isset($dataForm['active']) ) ? 0 : 1;
        
        //Valida os dados
        //$this->validate($request, $this->country->rules);
        /*
         $messages = [
         'name.required' => 'O campo nome é de preenchimento obrigatório!',
         'number.numeric' => 'Precisa ser apenas números!',
         'number.required' => 'O campo número é de preenchimento obrigatório!',
         ];
         $validate = validator($dataForm, $this->country->rules, $messages);
         if( $validate->fails() ) {
         return redirect()
         ->route('Paises.create')
         ->withErrors($validate)
         ->withInput();
         }
         *
         */
        
        //Faz o cadastro
        $insert = $this->country->create($dataForm);
        
        if( $insert )
            return redirect()->route('Paises.index');
            else
                return redirect()->route('Paises.create');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $country = $this->country->find($id);
        
        $title = "País:{$country->id} {$country->name}";
        
        return view('painel.countries.show', compact('country', 'title'));
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
        $country = $this->country->find($id);
        
        $title = "Editar País:{$country->id} {$country->name}";
        
       // $categorys = ['eletronicos', 'moveis', 'limpeza', 'banho'];
        
        return view('painel.countries.create-edit', compact('title', 'country'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(countryFormRequest $request, $id)
    {
        //Recupera todos os dados do formulário
        $dataForm = $request->all();
        
        //Recupera o item para editar
        $country = $this->country->find($id);
        
        //Verifica se o produto está ativado
        $dataForm['active'] = ( !isset($dataForm['active']) ) ? 0 : 1;
        
        //Altera os itens
        $update = $country->update($dataForm);
        
        //Verifica se realmente editou
        if( $update )
            return redirect()->route('Paises.index');
            else
                return redirect()->route('Paises.edit', $id)->with(['errors' => 'Falha ao editar']);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $country = $this->country->find($id);
        
        $delete = $country->delete();
        
        if( $delete )
            return redirect()->route('Paises.index');
            else
                return redirect()->route('Paises.show', $id)->with(['errors' => 'Falha ao deletar']);
    }
    
    public function tests()
    {
        /*
         $prod = $this->country;
         $prod->name = 'Nome do Produto';
         $prod->number = 131231;
         $prod->active = true;
         $prod->category = 'eletronicos';
         $prod->description = 'Description do produto aqui';
         $insert = $prod->save();
         
         if( $insert )
         return 'Inserido com sucesso';
         else
         return 'Falha ao inserir';
         *
         */
         /*
          $insert = $this->country->create([
          'name'          => 'Nome do Produto 2',
          'number'        => 434435,
          'active'        => false,
          'category'      => 'eletronicos',
          'description'   => 'Descrição vem aqui',
          ]);
          if( $insert )
          return "Inserido com sucesso, ID: {$insert->id}";
          else
          return 'Falha ao inserir';
          *
          */
          /*
           $prod = $this->country->find(5);
           $prod->name = 'Update 2';
           $prod->number = 797890;
           $update = $prod->save();
           
           if( $update )
           return 'Alterado com sucesso!';
           else
           return 'Falha ao alterar.';
           *
           */
           /*
            $prod = $this->country->find(6);
            $update = $prod->update([
            'name'          => 'Update Test',
            'number'        => 6765756,
            'active'        => true,
            ]);
            
            if( $update )
            return 'Alterado com sucesso!';
            else
            return 'Falha ao alterar.';
            *
            */
            
            /*
             $update = $this->country
             ->where('number', 6765756)
             ->update([
             'name'          => 'Update Test 2',
             'number'        => 67657560,
             'active'        => false,
             ]);
             
             if( $update )
             return 'Alterado com sucesso 2!';
             else
             return 'Falha ao alterar.';
             *
             
             $delete = $this->country
             ->where('number', 67657560)
             ->delete();
             
             if( $delete )
                 return 'Deletado com sucesso 2';
                 else
                     return 'Falha ao deletar';*/
    }
    
    public function search(Request $request)
    {
        //Pega os dados do formulário
        $dataForm = $request->except('_token');
        $keySearch = $dataForm['search'];
        
        //Título da página
        $title = "Resultados para País: {$keySearch}";
        
        //Faz o filtro dos dados
        $countries = $this->country
        ->where('name', 'LIKE', "%$keySearch%")
        ->orWhere('initials', 'LIKE', "%$keySearch%")
        ->paginate($this->totalPage);
        
        return view('painel.countries.index', compact('countries', 'title', 'dataForm'));
    }
}
