<?php

namespace App\Http\Controllers\Api\V1;

use App\Enum\HttpStatusCode;
use App\Exceptions\Api\V1\ApiException;
use App\Http\Resources\V1\FeedNew;
use App\Http\Resources\V1\FeedNewCollection;
use App\Models\V1\NewFeed as NewFeedModel;
use App\Models\V1\NewFeed;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Constroller com recursos do feed de notícias.
 * .
 * @package App\Http\Controllers\Api\V1
 */
class FeedController extends Controller
{
    /**
     * Método responsável por retornar uma lista de publicações
     * através da API.
     */
    public function listNews(Request $request)
    {
        $perPage = $request->get('per_page', 15);

        $page = $request->get('page', 1);

        $filter = $request->get('filter');

        $news = NewFeedModel::orderBy('publication_date', 'DESC');

        if (!empty($filter)) {
            $news->where('title', 'LIKE', "%{$filter}%")
                ->orWhere('description', 'LIKE', "%{$filter}%");
        }

        $news = $news->paginate($perPage, ['*'], 'page', $page);

        return new FeedNewCollection($news);
    }

    /**
     * Método repsonsável por retornar um único recurso de uma publicação
     * através da API.
     *
     * @param string $identifier Identificador da publicação.
     * @return FeedNew
     * @throws ApiException
     */
    public function showNews($identifier)
    {
        $newsFeed = NewFeedModel::find($identifier);

        if (empty($newsFeed)) {
            throw new ApiException(
                HttpStatusCode::NOT_FOUND(),
                'Recurso de publicação não encontrado.'
            );
        }

        return new FeedNew($newsFeed);
    }
}