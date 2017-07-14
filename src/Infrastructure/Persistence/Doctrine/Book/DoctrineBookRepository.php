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

    public function findById($id)
    {
        return $this->find($id);
    }

    public function update($book)
    {
        $this->_em->persist($book);
        $this->_em->flush();
    }
}