<?php
/**
 * Created by PhpStorm.
 * User: gabrieluser
 * Date: 12/31/18
 * Time: 12:13 PM
 */

namespace App\Services\V1\GloboFeed\Data\Entity;


class Feed
{
    /** @var string $title Titulo da publicação. */
    private $title;

    /** @var string $link Link da publicação. */
    private $link;

    /** @var string $guid Identificador da publicação. */
    private $guid;

    /** @var string $description Descrição da publicação. */
    private $description;

    /** @var string $category Categoria da publicação. */
    private $category;

    /** @var \DateTime $publicationDate Data de publicação. */
    private $publicationDate;

    /**
     * Feed constructor.
     * @param string $title
     * @param string $link
     * @param string $guid
     * @param string $description
     * @param string $category
     * @param \DateTime $publicationDate
     */
    public function __construct(
        string $title,
        string $link,
        string $guid,
        string $description,
        string $category,
        \DateTime $publicationDate
    ) {
        $this->title = $title;
        $this->link = $link;
        $this->guid = $guid;
        $this->description = $description;
        $this->category = $category;
        $this->publicationDate = $publicationDate;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Feed
     */
    public function setTitle(string $title): Feed
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getLink(): string
    {
        return $this->link;
    }

    /**
     * @param string $link
     * @return Feed
     */
    public function setLink(string $link): Feed
    {
        $this->link = $link;
        return $this;
    }

    /**
     * @return string
     */
    public function getGuid(): string
    {
        return $this->guid;
    }

    /**
     * @param string $guid
     * @return Feed
     */
    public function setGuid(string $guid): Feed
    {
        $this->guid = $guid;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Feed
     */
    public function setDescription(string $description): Feed
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category;
    }

    /**
     * @param string $category
     * @return Feed
     */
    public function setCategory(string $category): Feed
    {
        $this->category = $category;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getPublicationDate(): \DateTime
    {
        return $this->publicationDate;
    }

    /**
     * @param \DateTime $publicationDate
     * @return Feed
     */
    public function setPublicationDate(\DateTime $publicationDate): Feed
    {
        $this->publicationDate = $publicationDate;
        return $this;
    }
}