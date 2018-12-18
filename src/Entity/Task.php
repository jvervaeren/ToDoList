<?php
namespace App\Entity;

use Doctrine\ORM\Mapping

/**
 * @Entity
 * @Table(name="task")
 */
class Task
{
	/**
	 * @Id
	 * @GeneratedValue
	 * @ORM\Column(type="integer")
	 */
	private $id;

	/**
	 * @ORM\Column(type="string", length=255)
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