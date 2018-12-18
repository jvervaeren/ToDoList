<?php
namespace App\Service;

use App\Entity\Task;
use App\Entity\TaskStatus;

use Doctrine\ORM\EntityManagerInterface;

class AddTaskService
{
	private $entityManager;

	public function __construct(EntityManagerInterface $entityManager)
	{
		$this->entityManager = $entityManager;
	}

	/**
	 * Add a task to the database alongside 
	 * @param string $description
	 * @return []
	 */
	public function addTask($description)
	{
		$task = new Task();
		$task->setDescription($description);

		try {
			$this->entityManager->persist($task);
			$this->entityManager->flush();
		} catch (\Exception $ex) {
			return ['succcess' => false];
		}

		$taskStatus = new TaskStatus();
		$taskStatus->setTaskId($task->getId());

		try {
			$this->entityManager->persist($taskStatus);
			$this->entityManager->flush();
		} catch (\Exception $e) {
			$this->entityManager->remove($task);
			$this->entityManager->flush();
			return ['success' => false];
		}

		return ['success' => true, 'task_id' => $task->getId()];
	}
}