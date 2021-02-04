<?php
namespace Studos\Redacao1000;

final class Redaction extends Base
{
    const CORRECTION_MODE_ENEM2020 = 'ENEM_2020';

    /**
     * Efetua o cadastramento de uma redação para correção.
     * O acesso para o serviço de cadastro de escola deverá ser feito pelo parceiro autenticado na API de login.
     *
     * @param string $codeStudent
     * @param string $body
     * @param string $idTopic
     * @param string $mode
     * @param string|null $taskId
     * @param string|null $urlPostBack
     * @return array
     */
    public function text(
        string $codeStudent,
        string $body,
        string $idTopic,
        string $mode = self::CORRECTION_MODE_ENEM2020,
        string $taskId = null,
        string $urlPostBack = null
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

        if (!empty($urlPostBack)) {
            $params['urlPostback'] = $urlPostBack;
        }

        return $this->request('POST', 'redacao/texto', $params);
    }

    /**
     * Efetua o cadastramento de uma redação para correção.
     * O acesso para o serviço de cadastro de escola deverá ser feito pelo parceiro autenticado na API de login.
     *
     * @param string $codeStudent
     * @param string $image
     * @param string $idTopic
     * @param string $mode
     * @param string|null $taskId
     * @param string|null $urlPostBack
     * @return array
     */
    public function image(
        string $codeStudent,
        string $image,
        string $idTopic,
        string $mode = self::CORRECTION_MODE_ENEM2020,
        string $taskId = null,
        string $urlPostBack = null
    ): array {
        $params = [
            [
                'name' => "codigoAlunoParceiro",
                'contents' => $codeStudent,
            ],
            [
                'name' => "idTema",
                'contents' => $idTopic,
            ],
            [
                'name' => "modeloCorrecao",
                'contents' => $mode ?? self::CORRECTION_MODE_ENEM2020,
            ],
            [
                'name' => "imagemRedacao",
                'contents' => fopen($image, 'r'),
            ],
        ];

        if (!empty($taskId)) {
            $params[] = [
                'name' => 'tarefaId',
                'contents' => $taskId,
            ];
        }

        if (!empty($urlPostBack)) {
            $params[] = [
                'name' => 'urlPostback',
                'contents' => $urlPostBack,
            ];
        }

        return $this->upload('redacao/imagem', $params);
    }
}
