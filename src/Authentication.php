<?php
namespace Studos\Redacao1000;

final class Authentication extends Base
{
    /**
     * Autêntica o usuário e obtém os dados do mesmo, inclusive o token de acesso.
     * A cada chamada desse método um novo Token é gerado, esse token deve ser informado como
     * header em outras operações.
     *
     * @param string $login
     * @param string $password
     * @return array
     */
    public function login(string $login, string $password): array
    {
        return $this->request('POST', 'autenticacao', ['login' => $login, 'senha' => $password]);
    }
}
