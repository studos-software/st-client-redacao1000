<?php
namespace Studos\Redacao1000;

final class Redaction extends Base
{
    const CORRECTION_MODE_ENEM2020 = 'ENEM_2020';

    /**
     * Efetua o cadastramento de uma redação para correção.
     * O acesso para os erviço de cadastro de escola deverá ser feito pelo parceiro autenticado na API de login.
     *
     * @param string $codeStudent
     * @param string $body
     * @param string $idTopic
     * @param string $mode
     * @param string|null $taskId
     * @return array
     */
    public function text(
        string $codeStudent,
        string $body,
        string $idTopic,
        string $mode = self::CORRECTION_MODE_ENEM2020,
        string $taskId = null
    ): array {
        $params = [
            "codigoAlunoParceiro" => $codeStudent,
            "corpo" => $body,
            "idTema" => $idTopic,
            "modeloCorrecao" => $mode ?? self::CORRECTION_MODE_ENEM2020,
        ];

        if (!empty($taskId)) {
            $params['tarefaId'] = $taskId;
        }

        return $this->request('POST', 'redacao/texto', $params);
    }
}
