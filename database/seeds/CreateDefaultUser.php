<?php

use App\Models\V1\User;
use Illuminate\Database\Seeder;

/**
 * Seed responsável por criar os usuários default da aplicação.
 */
class CreateDefaultUser extends Seeder
{
    /**
     * Método responsável por executar o seed de criação de usuários default.
     *
     * @return void
     */
    public function run()
    {
        $user = new User([
            'name' => 'Meu Câmbio Teste',
            'email' => 'test@meucambio.com.br',
            'password' => \Illuminate\Support\Facades\Hash::make('root')
        ]);

        $user->save();
    }
}
