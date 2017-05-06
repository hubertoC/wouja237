<?php

namespace HZ\Wonja237Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Artiste
 *
 * @ORM\Table(name="artiste")
 * @ORM\Entity(repositoryClass="HZ\Wonja237Bundle\Repository\ArtisteRepository")
 */
class Artiste
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="surname", type="string", length=255)
     */
    private $surname;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=255)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="sexe", type="string", length=255)
     */
    private $sexe;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="style", type="string", length=255)
     */
    private $style;

    /**
     * @var string
     *
     * @ORM\Column(name="number", type="string", length=255)
     */
    private $number;

    /**
     * @var bool
     *
     * @ORM\Column(name="lu", type="boolean")
     */
    private $lu;



    /**
     * @ORM\OneToOne(targetEntity="HZ\Wonja237Bundle\Entity\Image", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=false)
     */
     private $image;


 /**
  * @ORM\OneToOne(targetEntity="HZ\Wonja237Bundle\Entity\Video", cascade={"persist","remove"})
  * @ORM\JoinColumn(nullable=false)
  */
  private $video;

  /**
     * @ORM\OneToMany(targetEntity="Commentaire", mappedBy="artiste")
     */
    protected $commentaire;

    /**
       * @ORM\OneToMany(targetEntity="Reservation", mappedBy="artiste")
       */
      protected $reservation;

  /**
   *
   * @ORM\ManyToMany(targetEntity="HZ\Wonja237Bundle\Entity\Category", cascade={"persist"})
   * @ORM\JoinColumn(nullable=false)
   */
   private $categories;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Artiste
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set surname
     *
     * @param string $surname
     *
     * @return Artiste
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return Artiste
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return Artiste
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set sexe
     *
     * @param string $sexe
     *
     * @return Artiste
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;

        return $this;
    }

    /**
     * Get sexe
     *
     * @return string
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Artiste
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set style
     *
     * @param string $style
     *
     * @return Artiste
     */
    public function setStyle($style)
    {
        $this->style = $style;

        return $this;
    }

    /**
     * Get style
     *
     * @return string
     */
    public function getStyle()
    {
        return $this->style;
    }

    /**
     * Set number
     *
     * @param string $number
     *
     * @return Artiste
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set lu
     *
     * @param boolean $lu
     *
     * @return Artiste
     */
    public function setLu($lu)
    {
        $this->lu = $lu;

        return $this;
    }

    /**
     * Get lu
     *
     * @return bool
     */
    public function getLu()
    {
        return $this->lu;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set image
     *
     * @param \HZ\Wonja237Bundle\Entity\Image $image
     *
     * @return Artiste
     */
    public function setImage(\HZ\Wonja237Bundle\Entity\Image $image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \HZ\Wonja237Bundle\Entity\Image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set video
     *
     * @param \HZ\Wonja237Bundle\Entity\Video $video
     *
     * @return Artiste
     */
    public function setVideo(\HZ\Wonja237Bundle\Entity\Video $video)
    {
        $this->video = $video;

        return $this;
    }

    /**
     * Get video
     *
     * @return \HZ\Wonja237Bundle\Entity\Video
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * Add category
     *
     * @param \HZ\Wonja237Bundle\Entity\Category $category
     *
     * @return Artiste
     */
    public function addCategory(\HZ\Wonja237Bundle\Entity\Category $category)
    {
        $this->categories[] = $category;

        return $this;
    }

    /**
     * Remove category
     *
     * @param \HZ\Wonja237Bundle\Entity\Category $category
     */
    public function removeCategory(\HZ\Wonja237Bundle\Entity\Category $category)
    {
        $this->categories->removeElement($category);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategories()
    {
        return $this->categories;
    }



    /**
     * Add comment
     *
     * @param \HZ\Wonja237Bundle\Entity\Commentaire $comment
     *
     * @return Artiste
     */
    public function addComment(\HZ\Wonja237Bundle\Entity\Commentaire $comment)
    {
        $this->comments[] = $comment;

        return $this;
    }

    /**
     * Remove comment
     *
     * @param \HZ\Wonja237Bundle\Entity\Commentaire $comment
     */
    public function removeComment(\HZ\Wonja237Bundle\Entity\Commentaire $comment)
    {
        $this->comments->removeElement($comment);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Add commentaire
     *
     * @param \HZ\Wonja237Bundle\Entity\Commentaire $commentaire
     *
     * @return Artiste
     */
    public function addCommentaire(\HZ\Wonja237Bundle\Entity\Commentaire $commentaire)
    {
        $this->commentaire[] = $commentaire;

        return $this;
    }

    /**
     * Remove commentaire
     *
     * @param \HZ\Wonja237Bundle\Entity\Commentaire $commentaire
     */
    public function removeCommentaire(\HZ\Wonja237Bundle\Entity\Commentaire $commentaire)
    {
        $this->commentaire->removeElement($commentaire);
    }

    /**
     * Get commentaire
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * Add reservation
     *
     * @param \HZ\Wonja237Bundle\Entity\Reservation $reservation
     *
     * @return Artiste
     */
    public function addReservation(\HZ\Wonja237Bundle\Entity\Reservation $reservation)
    {
        $this->reservation[] = $reservation;

        return $this;
    }

    /**
     * Remove reservation
     *
     * @param \HZ\Wonja237Bundle\Entity\Reservation $reservation
     */
    public function removeReservation(\HZ\Wonja237Bundle\Entity\Reservation $reservation)
    {
        $this->reservation->removeElement($reservation);
    }

    /**
     * Get reservation
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReservation()
    {
        return $this->reservation;
    }
}
