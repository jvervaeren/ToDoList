<?php
namespace App\Entity;

use Doctrine\ORM\Mapping

/**
 * @Entity
 * @Table(name="task_status")
 */
class TaskStatus
{
	/**
	 * @Id
	 * @GeneratedValue
	 * @ORM\Column(type="integer")
	 */
	private $id;

	/**
	 * @ORM\Column(type="integer")
	 */
	private $task_id;

	/**
	 * @ORM\Column(type="integer")
	 */
	private $completed;

	/**
	 * @ORM\Column(type="integer")
	 */
	private $canceled;

	/**
	 * @return integer
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @return integer
	 */
	public function getTaskId()
	{
		return $this->task_id;
	}

	/**
	 * @param integer $taskId
	 * @return TaskStatus
	 */
	public function setTaskId($taskId)
	{
		$this->task_id = $taskId;

		return $this;
	}

	/**
	 * @return integer
	 */
	public function getCompleted()
	{
		return $this->completed;
	}

	/**
	 * @param integer $complete
	 * @return TaskStatus
	 */
	public function setCompleted($complete)
	{
		$this->completed = $complete;

		return $this;
	}

	/**
	 * @return integer
	 */
	public function getCanceled()
	{
		return $this->canceled;
	}

	/**
	 * @param integer $canceled
	 * @return TaskStatus
	 */
	public function setCanceled($canceled)
	{
		$this->canceled = $canceled;

		return $this;
	}
}