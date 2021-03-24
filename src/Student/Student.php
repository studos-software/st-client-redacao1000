<?php

namespace Studos\Redacao1000\Student;

use Studos\Redacao1000\Base;

final class Student extends Base
{
    /**
     * Efetua o cadastramento de um aluno associado a uma turma e a um parceiro.
     * O acesso para o serviço de cadastro de escola deverá ser feito pelo parceiro autenticado na API
     * de login.
     *
     * @param string $codeStudent
     * @param string $codeSchool
     * @param string $codeRegistration
     * @param string $codeSchoolClass
     * @param string $email
     * @param string $name
     * @param int|null $taskId
     * @param bool $generateAccessToken
     * @return array
     */
    public function signup(
        string $codeStudent,
        string $codeSchool,
        string $codeRegistration,
        string $codeSchoolClass,
        string $email,
        string $name,
        int $taskId = null,
        bool $generateAccessToken = false
    ): array {
        $params = [
            "codigoAlunoParceiro" => $codeStudent,
            "codigoEscolaParceiro" => $codeSchool,
            "codigoMatricula" => $codeRegistration,
            "codigoTurmaParceiro" => $codeSchoolClass,
            "email" => $email,
            "nome" => $name,
            "gerarTokenAcesso" => $generateAccessToken

        ];

        if (!empty($taskId)) {
            $params['tarefaId'] = $taskId;
        }

        return $this->request('POST', 'aluno', $params);
    }
}
