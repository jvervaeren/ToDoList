<?php
namespace App\Service;

use App\Entity\TaskStatus;

use Doctrine\ORM\EntityManagerInterface;

class CancelTaskService
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
	public function cancelTask($id)
	{
		$task = $this->entityManager->getRepository(TaskStatus::class)->findByTaskId($id);

		if (!$task) {
			return false;
		}

		$task->setCanceled(1);
		
		try {
			$this->entityManager->flush();
		} catch (\Exception $ex) {
			return false;
		}

		return true;
	}
}