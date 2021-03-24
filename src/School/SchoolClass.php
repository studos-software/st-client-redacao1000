<?php

namespace Studos\Redacao1000\School;

use Studos\Redacao1000\Base;

final class SchoolClass extends Base
{
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
    public function signup(string $year, string $codeSchool, string $codeClass, string $name): array
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
