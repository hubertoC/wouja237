<?php

namespace HZ\Wonja237Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="HZ\Wonja237Bundle\Repository\CategoryRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Category
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
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;


    /**
     * @var string
     *
     * @ORM\Column(name="alt", type="string", length=255)
     */
    private $alt;





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
     * @return Category
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
     * Set url
     *
     * @param string $url
     *
     * @return Category
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set alt
     *
     * @param string $alt
     *
     * @return Category
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;

        return $this;
    }

    /**
     * Get alt
     *
     * @return string
     */
    public function getAlt()
    {
        return $this->alt;
    }







    private $file;

    private $tempFilename;


    public function setFile(UploadedFile $file)
    {
      $this->file = $file;

      if(null !== $this->url){
        $this->tempFilename = $this->url;

        $this->url = null;
        $this->alt = null;
      }
    }

    public function getFile()
    {
      return $this->file;
    }



    /**
    * @ORM\PrePersist()
    * @ORM\PreUpdate()
    */
    public function preUpload()
    {
      if(null === $this->file){
        return;
      }

      $this->url = $this->file->guessExtension();

      $this->alt = $this->file->getClientOriginalName();

    }

    /**
   * @ORM\PostPersist()
   * @ORM\PostUpdate()
   */
     public function upload()
     {
       if(null === $this->file){
         return;
       }


       if(null !== $this->tempFilename){
         $oldFile = $this->getUploadRootDir().'/'.$this->id.'.'.$this->tempFilename;
         if(file_exists($oldFile)){
           unlink($oldFile);
         }
       }


       $this->file->move(
         $this->getUploadRootDir(),
         $this->id.'.'.$this->url
       );
     }


     /**
   * @ORM\PreRemove()
   */
      public function preRemoveUpload()
      {
        $this->tempFilename = $this->getUploadRootDir().'/'.$this->id.'.'.$this->url;
      }


      /**
   * @ORM\PostRemove()
   */
       public function removeUpload()
       {
         if(file_exists($this->tempFilename)){
           unlink($this->tempFilename);
         }
       }

       public function getUploadDir()
       {
         return 'uploads/category';
       }

       protected function getUploadRootDir()
       {
         return __DIR__.'/../../../../web/'.$this->getUploadDir();
       }


    public function __toString(){
          return $this->getFile();
        }

        public function getWebPath()
        {
          return $this->getUploadDir().'/'.$this->getId().'.'.$this->getUrl();
        }

}
