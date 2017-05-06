<?php

namespace HZ\Wonja237Bundle\Controller;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use HZ\Wonja237Bundle\Entity\Artiste;


class LoadArtiste extends AbstractFixture implements orderedFixtureInterface
{
  // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
  public function load(ObjectManager $manager)
  {
  $artiste = new Artiste();
  $artiste->setName("Charlotte");
  $artiste->setSurname('Dypanda');
  $artiste->setEmail('charlotte@yahoo.com');
  $artiste->setSexe('F');
  $artiste->setStyle('Love');
  $artiste->setStatus('Solo');
  $artiste->setVille('Douala');
  $artiste->setNumber('832943948394');
  $artiste->setLu(1);
  $artiste->setImage($this->getReference('image'));
  $artiste->setVideo($this->getReference('video'));
  $artiste->addCategory($this->getReference('category'));

  $manager->persist($artiste);

  $artiste1 = new Artiste();
  $artiste1->setName("Locko");
  $artiste1->setSurname('Lockooooo');
  $artiste1->setEmail('Locko@yahoo.com');
  $artiste1->setSexe('M');
  $artiste1->setStyle('Love');
  $artiste1->setStatus('Solo');
  $artiste1->setVille('Douala');
  $artiste1->setNumber('049587');
  $artiste1->setLu(1);
  $artiste1->setImage($this->getReference('image1'));
  $artiste1->setVideo($this->getReference('video1'));
  $artiste1->addCategory($this->getReference('category1'));

  $manager->persist($artiste1);



  $artiste2 = new Artiste();
  $artiste2->setName("X-maleya");
  $artiste2->setSurname('X-maleyaaaaa');
  $artiste2->setEmail('Xmaleya@yahoo.com');
  $artiste2->setSexe('M');
  $artiste2->setStyle('Bouge');
  $artiste2->setStatus('groupe');
  $artiste2->setVille('yaounde');
  $artiste2->setNumber('09237432949');
  $artiste2->setLu(1);
  $artiste2->setImage($this->getReference('image2'));
  $artiste2->setVideo($this->getReference('video2'));
  $artiste2->addCategory($this->getReference('category2'));
  $manager->persist($artiste2);


  $manager->flush();
  $this->addReference('artiste',$artiste);
  $this->addReference('artiste1',$artiste1);
  $this->addReference('artiste2',$artiste2);


}

public function getOrder(){
  return 4;
}
}
