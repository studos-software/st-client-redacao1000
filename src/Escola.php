<?php
namespace Studos\Redacao1000;

final class Escola extends Base
{
    /**
     * Efetua o cadastramento de uma escola associada a um parceiro.
     * O acesso para o serviço de cadastro de escola deverá ser feito pelo parceiro autenticado na API
     * de login.
     *
     * @param string $code
     * @param string $name
     * @param string $city
     * @param string $state
     * @param string|null $email
     * @param string|null $phoneNumber
     * @return array
     */
    public function signup(
        string $code,
        string $name,
        string $city,
        string $state,
        string $email = null,
        string $phoneNumber = null
    ): array {
        $params = [
            "codigoEscolaParceiro" => $code,
            "municipio" => $city,
            "nome" => $name,
            "uf" => $state,
        ];

        if (filter_input(INPUT_GET, $email, FILTER_VALIDATE_EMAIL)) {
            $params['email'] = $email;
        }

        if (!empty($phoneNumber)) {
            $params['telefone'] = $phoneNumber;
        }

        return $this->request('POST', 'escola', $params);
    }

    /**
     * Efetua o cadastramento de uma turma associada a uma escola e a um parceiro.
     * O acesso para o serviço de cadastro de escola deverá ser feito pelo parceiro autenticado na API de login.
     *
     * @param string $year
     * @param string $codeSchool
     * @param string $codeClass
     * @param string $name
     * @return array
     */
    public function signupClass(string $year, string $codeSchool, string $codeClass, string $name): array
    {
        $params = [
            'codigoTurmaParceiro' => $codeClass,
            'codigoEscolaParceiro' => $codeSchool,
            'anoEscolar' => $year,
            'nome' => $name,
        ];

        return $this->request('POST', 'turma', $params);
    }
}
