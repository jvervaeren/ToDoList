<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

use App\Service\AddTaskService;
use App\Service\CompleteTaskService;
use App\Service\CancelTaskService;

use App\Entity\Task;

class TaskController
{
	/** 
	 * @Route("/api/task/create")
	 */
	public function create(Request $request, AddTaskService $addTaskService)
	{
		$description = $request->request->get('description');
		if (!$description) {
			return new JsonResponse(array('success' => false, 'reason' => 'No description provided'));
		}

		$response = $addTaskService->addTask($description);
		if (!$response['success']) {
			return new JsonResponse(array('success' => false, 'reason' => 'Failed to create task'));
		}

		return new JsonResponse(array('success' => true, 'id' => $response['task_id']));
	}

	/** 
	 * @Route("/api/task/update")
	 */
	public function update(Request $request, CompleteTaskService $completeTaskService, CancelTaskService $cancelTaskService)
	{
		$taskId = $request->request->get('task_id');
		if (!$taskId) {
			return new JsonResponse(array('success' => false, 'reason' => 'Task cannot be deleted'));
		}

		$updateStatus = $request->request->get('update_status');
		if (!$updateStatus) {
			return new JsonResponse(array('success' => false, 'reason' => 'No status update provided'));
		}

		$response = null;
		switch ($updateStatus) {
			case 'complete':
				$response = $completeTaskService->completeTask($taskId);
				break;
			case 'cancel':
				$response = $cancelTaskService->cancelTask($taskId);
				break;
			default:
				return new JsonResponse(array('success' => false, 'reason' => 'Invalid update status provided'));
		}

		if (!$response) {
			return new JsonResponse(array('success' => false, 'reason' => 'Task failed to update'));
		}

		return new JsonResponse(array('success' => true));
	}

	/**
	 * @Route("/api/task/get")
	 */
	public function get(Request $request, EntityManagerInterface $entityManager)
	{
		$taskId = $request->request->get('id');
		if (!$taskId) {
			return new JsonResponse(array('success' => false, 'reason' => 'No task id to search for'));
		}

		$task = $entityManager->getRepository(Task::class)->find($taskId);
		if (!$task) {
			return new JsonResponse(array('success' => false, 'reason' => 'Task not found'));
		}

		return new JsonResponse(array('success' => true, 'id' => $task->getId(), 'description' => $task->getDescription()));
	}
}