<?php

namespace App\Enum;

use Eloquent\Enumeration\AbstractEnumeration;

/**
 * Class HttpStatusCode
 *
 * @method $this NOT_FOUND()
 * @method $this INTERNAL_SERVER_ERROR()
 * @method $this UNAUTHORIZED()
 * @method $this METHOD_NOT_ALLOWED()
 * @method $this BAD_REQUEST()
 * @method $this UNPROCESSABLE_ENTITY()
 * @method $this ACCEPTED()
 * @method $this CREATED()
 * @method $this FORBIDDEN()
 * @method $this NO_CONTENT()
 * @method $this CONFLICT()
 *
 * @package App\Enum
 * @author Gabriel Anhaia
 */
class HttpStatusCode extends AbstractEnumeration
{
    /** @var int CREATED O pedido foi cumprido e resultou em um novo recurso que está sendo criado. */
    const CREATED = 201;

    /** @var int ACCEPTED O servidor processou a solicitação com sucesso, mas não é necessário nenhuma resposta. */
    const ACCEPTED = 202;

    /**
     * @var int NO_CONTENT O pedido foi aceito para processamento, mas o tratamento não
     * foi concluído. O pedido poderá ou não vir a ser posta em prática, pois pode ser
     * anulado quando o processamento ocorre realmente.
     */
    const NO_CONTENT = 204;

    /** @var int BAD_REQUEST O pedido não pôde ser entregue devido à sintaxe incorreta. */
    const BAD_REQUEST = 400;

    /**
     * @var int UNAUTHORIZED Semelhante ao 403 Proibido, mais especificamente para o uso quando a
     * autenticação é possível, mas não conseguiu ou ainda não foram fornecidos. A resposta deve
     * incluir um cabeçalho do campo www-authenticate contendo um desafio aplicável ao recurso
     * solicitado. Veja Basic autenticação de acesso e autenticação Digest acesso.
     */
    const UNAUTHORIZED = 401;

    /**
     * @var int FORBIDDEN O pedido é reconhecido pelo servidor mas este recusa-se a executá-lo. Ao contrário
     * resposta "401 Não Autorizado", autenticação não fará diferença e o pedido não deve ser requisitado novamente.
     */
    const FORBIDDEN = 403;

    /**
     * @var int NOT_FOUND O recurso requisitado não foi encontrado, mas pode ser disponibilizado
     * novamente no futuro. As solicitações subsequentes pelo cliente são permitidas.
     */
    const NOT_FOUND = 404;

    /**
     * @var int METHOD_NOT_ALLOWED Foi feita uma solicitação de um recurso usando um método de pedido não é
     * compatível com esse recurso, por exemplo, usando GET em um formulário, que exige que os dados a serem
     * apresentados via POST, PUT ou usar em um recurso somente de leitura.
     */
    const METHOD_NOT_ALLOWED = 405;

    /**
     * @var int CONFLICT Indica que a solicitação não pôde ser processada por causa do conflito no pedido,
     * como um conflito de edição.
     */
    const CONFLICT = 409;

    /**
     * @var int UNPROCESSABLE_ENTITY O pedido foi bem formado, mas era incapaz de ser seguido devido a
     * erros de semântica.
     */
    const UNPROCESSABLE_ENTITY = 422;

    /** @var int INTERNAL_SERVER_ERROR ndica um erro do servidor ao processar a solicitação (Erro de servidor). */
    const INTERNAL_SERVER_ERROR = 500;


    /** @var array $messages Mesangens padrão de erro. */
    protected $messages = [
        self::CREATED => 'Criado',
        self::ACCEPTED => 'Aceito',
        self::BAD_REQUEST => 'Requisição inválida.',
        self::UNAUTHORIZED => 'Não Autorizado.',
        self::NOT_FOUND => 'Não Encontrado.',
        self::METHOD_NOT_ALLOWED => 'Método não permitido.',
        self::UNPROCESSABLE_ENTITY => 'Entidade improcessável.',
        self::INTERNAL_SERVER_ERROR => 'Erro interno do servidor.',
        self::FORBIDDEN => 'Usuário não tem permissão.',
        self::CONFLICT => 'Conflito',
        self::NO_CONTENT => ''
    ];

    /**
     * Retorna a mensagem de erro de acordo com o código HTTP do enum.
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->messages[$this->value()];
    }
}