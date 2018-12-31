<?php

namespace App\Services\V1\GloboFeed\Contract;

use App\Services\V1\GloboFeed\Data\Collection\FeedCollection;

/**
 * Interface da integração com o feed da globo.
 *
 * @package App\Services\V1\GloboFeed
 */
interface FeedIntegration
{
    /**
     * Método responsável por fazer uma requisição com o feed de noticias da Globo.
     *
     * @return FeedCollection
     */
    public function getFeed(): FeedCollection;
}