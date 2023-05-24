<h3 class="font-semibold text-xl text-gray-800 leading-tight mb-1">
    Venda N° {{ $venda->id }}:
</h3>
<div class="w-11/12 my-5 flex flex-col items-start justify-start">
    <div class="my-3 flex items-start justify-start">
        <h4>Cliente:</h4>
        <p>{{ $venda->cliente ? $venda->cliente->nome : 'N/A' }}</p>
    </div>
    <div class="my-3">
        <h4>Pagamentos:</h4>
        <ul>
            @foreach ($venda->vendasPagamentos as $pagamento)
                <li>{{ $pagamento->pgmtDetalhe->descricao }} - {{ 'R$ ' . number_format($pagamento->valor, 2, ',', '.') }}</li>
            @endforeach
        </ul>
    </div>
    <div class="my-3">
        <h4>Produtos:</h4>
        <ul>
            @foreach ($venda->vendasProdutos as $vendaProduto)
                <li>{{$vendaProduto->quantidade}}X {{ $vendaProduto->produto->nome }} - {{ 'R$ ' . number_format($vendaProduto->produto->valor, 2, ',', '.') }}</li>
            @endforeach
        </ul>
    </div>
</div>
