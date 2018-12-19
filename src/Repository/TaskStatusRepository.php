<?php
namespace App\Repository;

use App\Entity\TaskStatus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class TaskStatusRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TaskStatus::class);
    }

    /**
     * Find task statuses by task id
     * @param  integer $id
     * @return TaskStatus
     */
    public function findByTaskId($id)
    {
    	$query = $this->createQueryBuilder('ts')
    		->andWhere('ts.task_id = :id')
    		->setParameter('id', $id)
    		->getQuery();

    	return $query->setMaxResults(1)->getOneOrNullResult();
    }
}