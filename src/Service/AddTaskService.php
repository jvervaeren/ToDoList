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
	 * Add a task to the database 
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
			return ['success' => false];
		}

		$taskStatus = new TaskStatus();
		$taskStatus->setTaskId($task->getId());
		$taskStatus->setCompleted(0);
		$taskStatus->setCanceled(0);

		try {
			$this->entityManager->persist($taskStatus);
			$this->entityManager->flush();
		} catch (\Exception $e) {
			return ['success' => false];
		}

		return ['success' => true, 'task_id' => $task->getId()];
	}
}