<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Vendas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex flex-col items-center justify-center">
                <div class="w-11/12 my-5 flex items-center justify-center">
                    <a href="{{ route('vendas.nova') }}"
                        class="font-semibold text-xl text-gray-800 leading-tight px-3 py-2 bg-indigo-400 rounded-xl">
                        Nova venda
                    </a>
                </div>
                <div class="w-full flex items-center justify-center">
                    <table class="w-11/12">
                        <thead align="left">
                            <tr>
                                <th>N°</th>
                                <th>Cliente</th>
                                <th>Data</th>
                                <th>Total</th>
                                <th>Mais informações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vendas as $venda)
                                <tr>
                                    <td>{{ $venda->id }}</td>
                                    <td>{{ $venda->cliente ? $venda->cliente->nome : 'N/A' }}</td>
                                    <td>{{ $venda->created_at->format('d/m/Y H:i:s') }}</td>
                                    <td>
                                        @php
                                            $total = 0;
                                            foreach ($venda->vendasProdutos as $vendasProduto) {
                                                $total += $vendasProduto->quantidade * $vendasProduto->produto->valor;
                                            }
                                            $totalFormatado = 'R$ ' . number_format($total, 2, ',', '.');
                                        @endphp
                                        {{ $totalFormatado }}
                                    </td>
                                    <td style="width: 150px;">
                                        <a href="{{ route('vendas.show', $venda->id) }}" target="_self">Abrir</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
