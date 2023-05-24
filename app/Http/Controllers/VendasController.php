<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PgmtDetalhe;
use App\Models\Cliente;
use App\Models\Produto;
use App\Models\VendasPagamento;
use App\Models\VendasProduto;
use App\Models\Venda;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Auth;

class VendasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $vendas = $user->vendas()->with('cliente', 'vendasProdutos:id,venda_id,produto_id,quantidade', 'vendasProdutos.produto:id,valor')->get();

        return view('vendas.index', ['vendas' => $vendas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Obtenha os dados necessários para o formulário (clientes, detalhes de pagamento, produtos)
        $clientes = Cliente::all();
        $pgmtDetalhes = PgmtDetalhe::all();
        $produtos = Produto::all();

        return view('vendas.nova', compact('clientes', 'pgmtDetalhes', 'produtos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validação dos dados do formulário
        $request->validate([
            'cliente' => 'nullable',
            'detalhe' => 'required|array',
            'detalhe.*' => 'exists:pgmt_detalhes,id',
            'valor' => 'required|array',
            'valor.*' => 'numeric',
            'produto' => 'required|array',
            'produto.*' => 'exists:produtos,id',
            'quantidade' => 'required|array',
            'quantidade.*' => 'numeric',
        ]);

        // Criação da nova venda
        $venda = new Venda();
        $venda->usuario_id = Auth::user()->id;
        if ($request->filled('cliente')) {
            $venda->cliente_id = $request->input('cliente');
        }
        $venda->save();

        // Salvando os pagamentos da venda
        $detalhes = $request->input('detalhe');
        $valores = $request->input('valor');

        foreach ($detalhes as $key => $detalhe) {
            $pagamento = new VendasPagamento();
            $pagamento->venda_id = $venda->id;
            $pagamento->detalhe_id = $detalhe;
            $pagamento->valor = $valores[$key];
            $pagamento->save();
        }

        // Salvando os produtos da venda
        $produtos = $request->input('produto');
        $quantidades = $request->input('quantidade');

        foreach ($produtos as $key => $produto) {
            $vendasProduto = new VendasProduto();
            $vendasProduto->venda_id = $venda->id;
            $vendasProduto->produto_id = $produto;
            $vendasProduto->quantidade = $quantidades[$key];
            $vendasProduto->save();
        }

        // Redirecionar ou retornar uma resposta de sucesso
        return redirect()->route('vendas.index')->with('success', 'Venda criada com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        $venda = $user->vendas()->with('cliente', 'vendasPagamentos','vendasPagamentos.pgmtDetalhe', 'vendasProdutos', 'vendasProdutos.produto')->find($id);
        return view('vendas.detalhes', ['venda' => $venda]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $venda = Venda::findOrFail($id);
        $venda->delete();

        return redirect()->route('vendas.index')->with('success', 'Venda apagada com sucesso.');
    }

    public function relatorio($id)
    {
         $user = Auth::user();
        $venda = $user->vendas()->with('cliente', 'vendasPagamentos','vendasPagamentos.pgmtDetalhe', 'vendasProdutos', 'vendasProdutos.produto')->find($id);
        $html = view('vendas.relatorio', ['venda' => $venda])->render();
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->render();
        $filename = 'relatorio_venda_' . $venda->id . '.pdf';

        return $dompdf->stream($filename);
    }
}
