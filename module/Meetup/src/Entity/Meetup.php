<?php

declare(strict_types=1);

namespace Meetup\Entity;

use Ramsey\Uuid\Uuid;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Meetup
 *
 * Attention : Doctrine génère des classes proxy qui étendent les entités, celles-ci ne peuvent donc pas être finales !
 *
 * @package Application\Entity
 * @ORM\Entity(repositoryClass="\Meetup\Repository\MeetupRepository")
 * @ORM\Table(name="meetup")
 */
class Meetup
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=36)
     **/
    private $id;

    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=2000, nullable=false)
     */
    private $description;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
     private $dateStart;

     /**
      * @ORM\Column(type="string", nullable=false)
      */
      private $dateEnd;

    public function __construct(string $title, string $description, string $dateStart, string $dateEnd)
    {
        $this->id = Uuid::uuid4()->toString();
        $this->title = $title;
        $this->description = $description;
        $this->dateStart = $dateStart;
        $this->dateEnd = $dateEnd;
    }

    /**
     * @return string
     */
    public function getID() : String
    { 
            return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle() : string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getDescription() : String
    {
        return $this->description;
    }


    public function setDescription(string $description) : void
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getDateStart() : String
    {
        return $this->dateStart;
    }

    public function setDateStart(string $dateStart) : String
    {
            return $this->dateStart = $dateStart;
    }

    /**
     * @return string
     */
    public function getDateEnd() : String
    {
        return $this->dateEnd;
    }

    public function setDateEnd(string $dateEnd) : String
    {
            return $this->dateEnd = $dateEnd;
    }
}
