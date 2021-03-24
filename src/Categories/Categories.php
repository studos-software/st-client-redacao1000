<?php

namespace Studos\Redacao1000\Categories;

use Studos\Redacao1000\Base;

final class Categories extends Base
{
    /**
     * Lista de categorias.
     * @return array
     */
    public function categories(): array
    {
        return $this->request('GET', 'categorias');
    }

    /**
     * Lista de Gêneros por categoria
     * @param int $categoryId
     * @return array
     */
    public function genres(int $categoryId): array
    {
        return $this->request('GET', "categorias/{$categoryId}/generos");
    }
}
