<?php
namespace HZ\Wonja237Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use HZ\Wonja237Bundle\Entity\Artiste;

class StarratingsystemController extends Controller
{
    public function indexAction()
    {
        $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('HZWonja237Bundle:Artiste')
          ;

        $listItems = $repository->findBy(
            array(),                      // Critere
            array('id' => 'asc'),        // Tri
            null,                         // Limite
            null                          // Offset
          );

      return $this->render('HZWonja237Bundle:ArtistePublic:indexTest.html.twig', array(
          'listItems' => $listItems,
      ));

    }
}
