<?php

namespace Studos\Redacao1000\Redaction;

use DateTime;
use Studos\Redacao1000\Base;

final class RedactionReport extends Base
{
    const DATE_FORMAT = "d/m/Y";

    /**
     * Efetua a consulta de uma correção de redação.
     * Retorna um objeto com a correção, se disponível.
     * @param string $redactionId
     * @return array
     */
    public function redaction(string $redactionId): array
    {
        return $this->request('GET', 'redacao/laudo/' . $redactionId);
    }

    /**
     * Efetua a consulta de uma correção de redação.
     * Retorna uma lista de correções, se possível.
     * @param string $taskId
     * @param DateTime $start
     * @param DateTime $end
     * @return array
     */
    public function period(string $taskId, DateTime $start, DateTime $end): array
    {
        $startDate = $start->format(self::DATE_FORMAT);
        $endDate = $end->format(self::DATE_FORMAT);
        $uri = "redacao/laudo/tarefa/{$taskId}/periodo?datInicio={$startDate}&datFim={$endDate}";

        return $this->request('GET', $uri);
    }

    /**
     * Efetua a consulta de uma correção de redação.
     * Retorna um objeto com a correção, se disponível.
     * @param string $taskId
     * @param string $studentId
     * @return array
     */
    public function student(string $taskId, string $studentId): array
    {
        $uri = "redacao/laudo/tarefa/{$taskId}/usuarioParceiro?usuarioParceiroId={$studentId}";

        return $this->request('GET', $uri);
    }

    /**
     * Efetua a consulta ao endpoint configurado para receber as correções.
     * Somente acontece se o parceiro informar um endpoint para receber a correção.
     * Ela será enviad assim que for corrigida ou liberada, nos casos de redações
     * com calibragem.
     * @return array
     */
    public function postBack(): array
    {
        return $this->request('GET', 'redacao/laudo/postback');
    }
}
