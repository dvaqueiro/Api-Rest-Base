<?php

namespace Dvaqueiro\Infrastructure\Persistence\Doctrine\Book;

use Doctrine\ORM\EntityRepository;
use Dvaqueiro\Domain\Model\Book\BookRepository;

/**
 * @author dvaqueiro
 */
class DoctrineBookRepository extends EntityRepository implements BookRepository
{

    public function findAll(): array
    {
        return $this->_em->createQuery('SELECT b FROM Dvaqueiro\Domain\Model\Book\Book b')
                ->getResult();
    }
}