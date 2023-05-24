<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{ route('vendas.index') }}">Vendas</a>->Detalhes
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h3 class="font-semibold text-xl text-gray-800 leading-tight mb-1">
                Venda N° {{ $venda->id }}:
            </h3>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex items-center justify-center">
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
                    <div class="my-3">
                        <a class="px-3 py-2 bg-indigo-400 rounded-xl" href="{{ route('vendas.relatorio', $venda->id) }}" target="_blank">Gerar PDF</a>
                        <form action="{{ route('vendas.apagar', $venda->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="px-3 py-2 bg-indigo-400 rounded-xl" type="submit">Apagar Venda</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
