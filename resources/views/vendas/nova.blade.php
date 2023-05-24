<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{route('vendas.index')}}">Vendas</a>->Nova venda
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex flex-col items-center justify-center">
            <form action="/vendas/nova" method="POST">
                @csrf

                @if ($errors->any())
                    <div class="alert alert-danger my-3">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="my-3">
                    <label for="cliente">Cliente:</label>
                    <select name="cliente" id="cliente">
                        <option value="">Nenhum</option>
                        @foreach ($clientes as $cliente)
                            <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
                        @endforeach
                    </select>
                </div>

                <h3 class="my-3">Adicionar Produtos:</h3>

                <div class="my-3" id="produtos-container">
                    <div class="produto">
                        <label for="produto1">Produto:</label>
                        <select name="produto[]" id="produto1">
                            @foreach ($produtos as $produto)
                                <option value="{{ $produto->id }}">{{ $produto->nome }}</option>
                            @endforeach
                        </select>

                        <label for="quantidade1">Quantidade:</label>
                        <input type="text" name="quantidade[]" id="quantidade1">
                    </div>
                </div>

                <button class="my-3 px-3 py-2 bg-indigo-400 rounded-xl" type="button" id="add-produto">Adicionar Produto</button>

                <h3 class="my-3">Adicionar Pagamentos:</h3>

                <div class="my-3" id="pagamentos-container">
                    <div class="pagamento">
                        <label for="detalhe1">Forma de Pagamento:</label>
                        <select name="detalhe[]" id="detalhe1">
                            @foreach ($pgmtDetalhes as $pgmtDetalhe)
                                <option value="{{ $pgmtDetalhe->id }}">{{ $pgmtDetalhe->descricao }}</option>
                            @endforeach
                        </select>

                        <label for="valor1">Valor:</label>
                        <input type="text" name="valor[]" id="valor1">
                    </div>
                </div>

                <button class="my-3 px-3 py-2 bg-indigo-400 rounded-xl" type="button" id="add-pagamento">Adicionar Pagamento</button>
                <br>
                <button class="my-3 px-3 py-2 bg-indigo-400 rounded-xl" type="submit">Salvar Venda</button>
            </form>
        </div>
    </div>

    <script>
        // Código JavaScript para adicionar novos campos de pagamento e produto

        // Contadores para os campos de pagamento e produto
        let pagamentoCount = 1;
        let produtoCount = 1;

        // Função para adicionar campos de pagamento
        function addPagamento() {
            pagamentoCount++;

            const pagamentoDiv = document.createElement('div');
            pagamentoDiv.classList.add('pagamento');

            pagamentoDiv.innerHTML = `
                <label for="detalhe${pagamentoCount}">Forma de Pagamento:</label>
                <select name="detalhe[]" id="detalhe${pagamentoCount}">
                    @foreach ($pgmtDetalhes as $pgmtDetalhe)
                        <option value="{{ $pgmtDetalhe->id }}">{{ $pgmtDetalhe->descricao }}</option>
                    @endforeach
                </select>

                <label for="valor${pagamentoCount}">Valor:</label>
                <input type="text" name="valor[]" id="valor${pagamentoCount}">
            `;

            const pagamentosContainer = document.getElementById('pagamentos-container');
            pagamentosContainer.appendChild(pagamentoDiv);
        }

        // Função para adicionar campos de produto
        function addProduto() {
            produtoCount++;

            const produtoDiv = document.createElement('div');
            produtoDiv.classList.add('produto');

            produtoDiv.innerHTML = `
                <label for="produto${produtoCount}">Produto:</label>
                <select name="produto[]" id="produto${produtoCount}">
                    @foreach ($produtos as $produto)
                        <option value="{{ $produto->id }}">{{ $produto->nome }}</option>
                    @endforeach
                </select>

                <label for="quantidade${produtoCount}">Quantidade:</label>
                <input type="text" name="quantidade[]" id="quantidade${produtoCount}">
            `;

            const produtosContainer = document.getElementById('produtos-container');
            produtosContainer.appendChild(produtoDiv);
        }

        // Event listeners para os botões de adicionar pagamento e produto
        document.getElementById('add-pagamento').addEventListener('click', addPagamento);
        document.getElementById('add-produto').addEventListener('click', addProduto);
    </script>

</x-app-layout>
