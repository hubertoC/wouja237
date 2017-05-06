<?php

namespace HZ\Wonja237Bundle\Controller;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use HZ\Wonja237Bundle\Entity\Image;

class LoadImage extends AbstractFixture implements orderedFixtureInterface
{
  // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
  public function load(ObjectManager $manager)
  {
  $image = new Image();
  $image->setUrl('http://www.africanmoove.com/wp-content/uploads/2015/10/3-interview-charlotte-dipanda.jpg');
  $image->setAlt("https://www.youtube.com/embed/nAL39LYkjk4");

  $manager->persist($image);

  $image1 = new Image();
  $image1->setUrl('http://www.buzzswagg.com/wp-content/uploads/2016/02/arthur-locko.jpg');
  $image1->setAlt("https://www.youtube.com/embed/nAL39LYkjk4");


  $manager->persist($image1);

  $image2 = new Image();
  $image2->setUrl('http://www.camer.be/UserFiles/file/images/monde/X_Maleya161115750.jpg');
  $image2->setAlt("https://www.youtube.com/embed/nAL39LYkjk4");


  $manager->persist($image2);

  $manager->flush();


  $this->addReference('image',$image);
  $this->addReference('image1',$image1);
  $this->addReference('image2',$image2);
}

public function getOrder(){
  return 2;
}
}
