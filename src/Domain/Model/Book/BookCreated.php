<?php

namespace Dvaqueiro\Domain\Model\Book;

use Ddd\Domain\DomainEvent;

/**
 * Description of BookCreated
 *
 * @author dvaqueiro
 */
class BookCreated implements DomainEvent
{
    private $bookId;
    private $occurredOn;

    function __construct($bookId)
    {
        $this->bookId = $bookId;
        $this->occurredOn = new \DateTimeImmutable();
    }

    public function occurredOn(): \DateTime
    {
        return $this->occurredOn;
    }
}