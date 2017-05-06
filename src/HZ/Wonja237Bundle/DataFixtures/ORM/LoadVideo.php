<?php

namespace HZ\Wonja237Bundle\Controller;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use HZ\Wonja237Bundle\Entity\video;


class LoadVideo extends AbstractFixture implements orderedFixtureInterface
{
  // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
  public function load(ObjectManager $manager)
  {
  $video = new video();
  $video->setUrl("https://www.youtube.com/embed/nAL39LYkjk4");
  $video->setAlt("https://www.youtube.com/embed/nAL39LYkjk4");


  $manager->persist($video);

  $video1 = new video();
  $video1->setUrl("https://www.youtube.com/embed/cqsPCi2gIzw");
  $video1->setAlt("https://www.youtube.com/embed/nAL39LYkjk4");

  $manager->persist($video1);

  $video2 = new video();
  $video2->setUrl("https://www.youtube.com/embed/gIkuAGg3KBs");
  $video2->setAlt("https://www.youtube.com/embed/nAL39LYkjk4");

  $manager->persist($video2);



  $manager->flush();
  $this->addReference('video',$video);
  $this->addReference('video1',$video1);
  $this->addReference('video2',$video2);


}
public function getOrder(){
  return 1;
}

}
