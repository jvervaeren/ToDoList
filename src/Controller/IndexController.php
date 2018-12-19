<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IndexController extends AbstractController
{
	/** 
	 * @Route("/")
	 */
	public function index()
	{
		$entityManager = $this->getDoctrine()->getManager();
		$dbConnection = $entityManager->getConnection();

		try {
			$sql = '
				SELECT t.id, t.description
				FROM task t
				INNER JOIN task_status ts ON ts.task_id = t.id
				WHERE ts.completed = 0
				AND ts.canceled = 0
				ORDER BY t.id ASC
			';

			$query = $dbConnection->prepare($sql);
			$query->execute();

			$tasks = ['tasks' => $query->fetchAll()];
		} catch (\Exception $ex) {
			$tasks = ['tasks' => []];
		}
		
		return $this->render('index/tasks.html.twig', 
			$tasks
		);
	}
}