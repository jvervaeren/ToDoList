<?php
namespace App\Entity;

use Doctrine\ORM\Mapping;

/**
 * @Mapping\Entity(repositoryClass="App\Repository\TaskRepository")
 */
class Task
{
	/**
	 * @Mapping\Id
	 * @Mapping\GeneratedValue
	 * @Mapping\Column(type="integer")
	 */
	private $id;

	/**
	 * @Mapping\Column(type="string", length=255)
	 */
	private $description;

	/**
	 * @return integer
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @return string
	 */
	public function getDescription()
	{
		return $this->description;
	}

	/**
	 * @param string $desc
	 * @return Task
	 */
	public function setDescription($desc)
	{
		$this->description = $desc;

		return $this;
	}
}