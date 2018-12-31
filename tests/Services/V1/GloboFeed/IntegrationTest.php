<?php

namespace App\Services\V1\GloboFeed;

use App\Services\V1\GloboFeed\Data\Collection\FeedCollection;
use App\Services\V1\GloboFeed\Data\Entity\Feed;
use GuzzleHttp\Client;
use Tests\TestCase;

/**
 *
 * Classe de testes do service de feed de noticias da globo.
 * @package App\Services\V1\GloboFeed
 */
class IntegrationTest extends TestCase
{
    /**
     * Testa de erro na comunicação ao buscar os feeds de publicações.
     *
     * @expectedException \Exception
     * @expectedExceptionMessage Erro na leitura do Feed.
     */
    public function testErrorComunicationGetFeed()
    {
        $httpClientMock = $this->getMockBuilder(Client::class)
            ->setMethods(['get'])
            ->getMock();

        $httpClientMock->expects($this->once())
            ->method('get')
            ->willThrowException(new \Exception('Error'));

        $mockIntegration = new Integration($httpClientMock);

        $mockIntegration->getFeed();
    }

    /**
     * Testa de erro na comunicação ao buscar os feeds de publicações.
     * (Retornando resultado vazio)
     *
     * @expectedException \Exception
     * @expectedExceptionMessage Erro na leitura do Feed.
     */
    public function testErrorEmptyFeed()
    {
        $httpClientMock = $this->getMockBuilder(Client::class)
            ->setMethods(['get'])
            ->getMock();

        $httpClientMock->expects($this->once())
            ->method('get')
            ->willReturn('');

        $mockIntegration = new Integration($httpClientMock);

        $mockIntegration->getFeed();
    }

    /**
     * Testa de erro na leitura do XML do feed.
     *
     * @dataProvider errorReadXmlDataProvider
     *
     * @expectedException \Exception
     * @expectedExceptionMessage Erro na leitura do XML retornado do Feed.
     * @param $httpClientMock
     * @throws \Exception
     */
    public function testErrorReadXml($httpClientMock)
    {
        $mockIntegration = new Integration($httpClientMock);

        $mockIntegration->getFeed();
    }

    /**
     * Testa o sucesso ao buscar os feeds de publicações.
     */
    public function testSuccessGetFeed()
    {
        $pathXmlResponse = getcwd()
            . DIRECTORY_SEPARATOR
            . 'tests'
            . DIRECTORY_SEPARATOR
            . 'responseFeed.xml';

        $mockBodyObject = $this->getMock(
            \stdClass::class,
            ['getContents'],
            ['getContents' => file_get_contents($pathXmlResponse)]
        );

        $mockResponseObject = $this->getMock(
            \GuzzleHttp\Psr7\Response::class,
            ['getBody'],
            ['getBody' => $mockBodyObject]
        );

        $mockClient = $this->getMock(
            Client::class,
            ['get'],
            ['get' => $mockResponseObject]
        );

        $integration = new Integration($mockClient);

        $feedCollection = $integration->getFeed();

        $expectedFeedCollection = new FeedCollection();
        $expectedFeedCollection->put(
            'https://g1.globo.com/economia/noticia/2018/12/31/mercado-estima-menos-inflacao-e-alta-maior-do-pib-em-2019.ghtml',
            new Feed(
                'Mercado estima menos inflação e alta maior do PIB em 2019',
                'https://g1.globo.com/economia/noticia/2018/12/31/mercado-estima-menos-inflacao-e-alta-maior-do-pib-em-2019.ghtml',
                'https://g1.globo.com/economia/noticia/2018/12/31/mercado-estima-menos-inflacao-e-alta-maior-do-pib-em-2019.ghtml',
                'TEXT 1',
                'G1',
                new \DateTime('2018-12-31T10:30:26-00:00')
            )
        );

        $expectedFeedCollection->put(
            'https://g1.globo.com/economia/noticia/2018/12/31/pedido-de-aposentadoria-pela-regra-8595-termina-e-beneficio-integral-fica-mais-dificil.ghtml',
            new Feed(
                'Pedido de aposentadoria pela regra 85/95 termina e benefício integral fica mais difícil',
                'https://g1.globo.com/economia/noticia/2018/12/31/pedido-de-aposentadoria-pela-regra-8595-termina-e-beneficio-integral-fica-mais-dificil.ghtml',
                'https://g1.globo.com/economia/noticia/2018/12/31/pedido-de-aposentadoria-pela-regra-8595-termina-e-beneficio-integral-fica-mais-dificil.ghtml',
                'TEXT 2',
                'G1',
                new \DateTime('2018-12-31T09:18:38-00:00')
            )
        );

        $this->assertEquals($expectedFeedCollection, $feedCollection);
    }

    /**
     * Provedor de dados para teste de erro de leitura de XML do feed.
     */
    public function errorReadXmlDataProvider()
    {
        return [
            [
                'httpClientMock' => $this->getMock(
                    Client::class,
                    ['get'],
                    ['get' => $this->getMock(
                        \GuzzleHttp\Psr7\Response::class,
                        ['getBody'],
                        [
                            'getBody' => $this->getMock(
                                \stdClass::class,
                                ['getContents'],
                                []
                            )
                        ]
                    )
                    ]
                )
            ],
            [
                'httpClientMock' => $this->getMock(
                    Client::class,
                    ['get'],
                    ['get' => $this->getMock(
                        \GuzzleHttp\Psr7\Response::class,
                        ['getBody'],
                        [
                            'getBody' => $this->getMock(
                                \stdClass::class,
                                ['getContents'],
                                ['getContents' => '<xml></xml>xml>']
                            )
                        ]
                    )
                    ]
                )
            ]
        ];
    }

    /**
     * Método genérico criado para facilitar a geração de mocks.
     *
     * @param $class
     * @param $methods
     * @param array $mockResponse
     * @param array $mockExceptions
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    public function getMock(
        $class,
        $methods,
        $mockResponse = [],
        $mockExceptions = []
    )
    {
        $httpClientMock = $this->getMockBuilder($class)
            ->setMethods($methods)
            ->getMock();

        foreach ($mockResponse as $methodName => $response) {
            $httpClientMock->expects($this->once())
                ->method($methodName)
                ->willReturn($response);
        }

        foreach ($mockExceptions as $methodName => $exception) {
            $httpClientMock->expects($this->once())
                ->method($methodName)
                ->willThrowException($exception);
        }

        return $httpClientMock;
    }
}