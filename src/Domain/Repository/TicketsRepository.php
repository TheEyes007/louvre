<?php

namespace App\Domain\Repository;

/**
 * Class TicketsRepository
 * @package App\Domain\Repository
 */
class TicketsRepository extends \Doctrine\ORM\EntityRepository
{

    /**
     * @param $date
     * @return array
     */
    public function countTicketsbydate($date)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
        SELECT dateofbooking, count(id) FROM tickets p
        WHERE p.dateofbooking = :date
        GROUP BY p.dateofbooking
        ';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['date' => $date]);

        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAll();
    }
}
