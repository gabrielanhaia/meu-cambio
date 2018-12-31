<?php
/**
 * Created by PhpStorm.
 * User: gabrieluser
 * Date: 12/31/18
 * Time: 12:18 PM
 */

namespace App\Services\V1\GloboFeed;


use App\Services\V1\GloboFeed\Data\Collection\FeedCollection;
use App\Services\V1\GloboFeed\Data\Entity\Feed;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;

/**
 * Classe responsável pela integração com o feed da Globo.
 *
 * @package App\Services\V1\GloboFeed
 */
class Integration implements Contract\FeedIntegration
{
    /** @var ClientInterface $httpClient Cliente para requisições HTTP. */
    private $httpClient;

    /**
     * Integration constructor.
     * @param null $httpClient Cliente HTTP.
     */
    public function __construct($httpClient = null)
    {
        if (empty($httpClient)) {
            $httpClient = new Client();
        }

        $this->httpClient = $httpClient;
    }

    /**
     * {@inheritdoc}
     * @throws \Exception
     */
    public function getFeed(): FeedCollection
    {
        try {
            $response = $this->httpClient->get('http://pox.globo.com/rss/g1/economia');

            if (empty($response)) {
                throw new \Exception;
            }

        } catch (\Exception $exception) {
            throw new \Exception('Erro na leitura do Feed.');
        }

        try {
            $xmlRawData = $response->getBody()->getContents();
            $xmlObject = simplexml_load_string($xmlRawData);

            if (empty($xmlObject)) {
                throw new \Exception;
            }

        } catch (\Exception $exception) {
            throw new \Exception('Erro na leitura do XML retornado do Feed.');
        }

        $feedCollection = new FeedCollection();
        foreach ($xmlObject->channel->item as $item) {
            $publicationDate = (string) $item->pubDate;

            $feedCollection->put(
                (string) $item->guid,
                new Feed(
                    (string) $item->title,
                    (string) $item->link,
                    (string) $item->guid,
                    (string) $item->description,
                    (string) $item->category,
                    \DateTime::createFromFormat('D, d M Y H:i:s T', $publicationDate)
                )
            );
        }

        return $feedCollection;
    }
}