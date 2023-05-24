<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        \App\Models\User::factory()->create([
            'name' => 'UsuarioTeste',
            'email' => 'emailUser@example.com',
            'password' => bcrypt('123456789')
        ]);
        \App\Models\Cliente::create([
            'usuario_id' => 1,
            'nome' => 'ClienteTeste',
            'cpf' => '00000000000',
            'email' => 'emailCliente@example.com',
            'data_nascimento' => '2002-03-18'
        ]);
        \App\Models\PgmtBandeira::create([
            'bandeira' => 'VISA',
        ]);
        \App\Models\PgmtForma::create([
            'forma' => 'DINHEIRO',
            'sigla' => 'DIN'
        ]);
        \App\Models\PgmtForma::create([
            'forma' => 'CARTÃO',
            'sigla' => 'CRT'
        ]);
        \App\Models\PgmtDetalhe::create([
            'forma_id' => 1,
            'descricao' => 'PAGAMENTO EM DINHEIRO',
            'avista' => 1,
            'parcela' => 0,
        ]);
        \App\Models\PgmtDetalhe::create([
            'forma_id' => 2,
            'bandeira_id' => 1,
            'descricao' => 'PAGAMENTO EM CARTÃO VISA DÉBITO',
            'debito_credito' => 'D',
            'avista' => 1,
            'parcela' => 0,
        ]);
        \App\Models\PgmtDetalhe::create([
            'forma_id' => 2,
            'bandeira_id' => 1,
            'descricao' => 'PAGAMENTO EM CARTÃO VISA CRÉDITO X1',
            'debito_credito' => 'C',
            'avista' => 0,
            'parcela' => 1,
        ]);
        \App\Models\PgmtDetalhe::create([
            'forma_id' => 2,
            'bandeira_id' => 1,
            'descricao' => 'PAGAMENTO EM CARTÃO VISA CRÉDITO X2',
            'debito_credito' => 'C',
            'avista' => 0,
            'parcela' => 2,
        ]);
        \App\Models\PgmtDetalhe::create([
            'forma_id' => 2,
            'bandeira_id' => 1,
            'descricao' => 'PAGAMENTO EM CARTÃO VISA CRÉDITO X3',
            'debito_credito' => 'C',
            'avista' => 0,
            'parcela' => 3,
        ]);
        \App\Models\Produto::create([
            'nome' => 'PC',
            'quantidade' => 15,
            'valor' => 2000,
        ]);
        \App\Models\Produto::create([
            'nome' => 'MOUSE',
            'quantidade' => 50,
            'valor' => 200,
        ]);
        \App\Models\Produto::create([
            'nome' => 'TECLADO',
            'quantidade' => 30,
            'valor' => 350,
        ]);
        \App\Models\Venda::create([
            'usuario_id' => '1',
        ]);
        \App\Models\Venda::create([
            'usuario_id' => '1',
            'cliente_id' => '1',
        ]);
        \App\Models\VendasProduto::create([
            'venda_id' => '1',
            'produto_id' => '1',
            'quantidade' => 1,
        ]);
        \App\Models\VendasProduto::create([
            'venda_id' => '1',
            'produto_id' => '2',
            'quantidade' => 1,
        ]);
        \App\Models\VendasProduto::create([
            'venda_id' => '2',
            'produto_id' => '3',
            'quantidade' => 1,
        ]);
        \App\Models\VendasPagamento::create([
            'venda_id' => '1',
            'detalhe_id' => '1',
            'valor' => 200,
        ]);
        \App\Models\VendasPagamento::create([
            'venda_id' => '1',
            'detalhe_id' => '4',
            'valor' => 2000,
        ]);
        \App\Models\VendasPagamento::create([
            'venda_id' => '2',
            'detalhe_id' => '1',
            'valor' => 350,
        ]);
    }
}
