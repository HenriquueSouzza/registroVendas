<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="w-11/12 my-5 flex items-center justify-center">
                    <a href="{{ route('vendas.index') }}"
                        class="mx-3 font-semibold text-xl text-gray-800 leading-tight px-3 py-2 bg-indigo-400 rounded-xl">
                        Vendas
                    </a>
                    <a href="{{ route('vendas.nova') }}"
                        class="mx-3 font-semibold text-xl text-gray-800 leading-tight px-3 py-2 bg-indigo-400 rounded-xl">
                        Nova venda
                    </a>
                    <a href="{{ route('cadastros') }}"
                        class="mx-3 font-semibold text-xl text-gray-800 leading-tight px-3 py-2 bg-indigo-400 rounded-xl">
                        Cadastrar cliente
                    </a>
                    <a href="{{ route('cadastros') }}"
                        class="mx-3 font-semibold text-xl text-gray-800 leading-tight px-3 py-2 bg-indigo-400 rounded-xl">
                        Cadastrar produto
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
