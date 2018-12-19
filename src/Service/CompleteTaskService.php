<?php
namespace App\Service;

use App\Entity\TaskStatus;

use Doctrine\ORM\EntityManagerInterface;

class CompleteTaskService
{
	private $entityManager;

	public function __construct(EntityManagerInterface $entityManager)
	{
		$this->entityManager = $entityManager;
	}

	/**
	 * @param integer $id
	 * @return boolean
	 */
	public function completeTask($id)
	{
		$task = $this->entityManager->getRepository(TaskStatus::class)->findByTaskId($id);
		if (!$task) {
			var_dump(get_class($task));die;
			return false;
		}

		$task->setCompleted(1);
		
		try {
			$this->entityManager->flush();
		} catch (\Exception $ex) {
			return false;
		}

		return true;
	}
}