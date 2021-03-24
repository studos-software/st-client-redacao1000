<?php

namespace Studos\Redacao1000\Redaction;

use Studos\Redacao1000\Base;

final class RedactionTheme extends Base
{
    /**
     * Efetua o cadastro de um tema para redação.
     *
     * @param string $title
     * @param int $category
     * @param int $genre
     * @param string $description
     * @param string|null $themeImage
     * @param bool $active
     * @param string|null $suggestion
     * @param string|null $teaserImage
     * @return array
     */
    public function signup(
        string $title,
        int $category,
        int $genre,
        string $description,
        string $themeImage,
        bool $active = true,
        string $suggestion = null,
        string $teaserImage = null
    ): array {
        $params = [
            [
                'name' => "titulo",
                'contents' => $title,
            ],
            [
                'name' => "categoriaId",
                'contents' => $category,
            ],
            [
                'name' => "generoId",
                'contents' => $genre,
            ],
            [
                'name' => "ativo",
                'contents' => $active,
            ],
            [
                'name' => "descricao",
                'contents' => $description,
            ],
            [
                'name' => "imagemTema",
                'contents' => fopen($themeImage, 'r'),
            ]
        ];

        // optional parameters
        if ($suggestion) {
            $params[] =         [
                'name' => "sugestaoUso",
                'contents' => $suggestion,
            ];
        }

        if ($teaserImage) {
            $params[] = [
                'name' => "imagemTeaser",
                'contents' => fopen($teaserImage, 'r'),
            ];
        }

        return $this->upload('tema', $params);
    }
}
