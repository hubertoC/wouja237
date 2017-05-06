<?php

namespace HZ\Wonja237Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use HZ\Wonja237Bundle\Form\RechercheType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\DependencyInjection\ContainerInterface;
use HZ\Wonja237Bundle\Form\CommentaireType;
use HZ\Wonja237Bundle\Entity\Commentaire;
use HZ\Wonja237Bundle\Entity\Reservation;
use HZ\Wonja237Bundle\Form\ReservationType;
use HZ\Wonja237Bundle\Form\EnregistrementType;
use HZ\Wonja237Bundle\Entity\Enregistrement;
use HZ\Wonja237Bundle\Entity\Contact;
use HZ\Wonja237Bundle\Form\ContactType;
use Symfony\Component\HttpFoundation\Response;


class ArtistePublicController extends Controller
{


    public function searchAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $requestString = $request->get('q');
        $entities =  $em->getRepository('HZWonja237Bundle:Artiste')->findEntitiesByString($requestString);
        if(!$entities) {
            $result['entities']['error'] = "Aucun resultat trouver pour cette recherche.";
        } else {
            $result = array('entities' => $this->getRealEntities($entities));
        }
        return new Response(json_encode($result));
    }
    public function getRealEntities($entities){
        foreach ($entities as $entity){
            $realEntities[$entity->getId()] = [$entity->getName() ,$entity->getSurname()];
        }

        return $realEntities;
    }



    public function indexAction()
    {
      $em = $this->getDoctrine()->getManager();

      $artiste = $em->getRepository('HZWonja237Bundle:Artiste')->findAll();
      shuffle($artiste);
      $category = $em->getRepository('HZWonja237Bundle:Category')->findAll();
      shuffle($category);

      $publicites = $em->getRepository('HZWonja237Bundle:Publicites')->findAll();
      shuffle($publicites);

        return $this->render('HZWonja237Bundle:ArtistePublic:index.html.twig', array('artiste' => $artiste, 'category' => $category, 'publicites' => $publicites));
    }


    public function categoryArtisteAction($category, $name)
    {
      $em = $this->getDoctrine()->getManager();



      $artiste = $em->getRepository('HZWonja237Bundle:Artiste')->byCategory($category);
             //exit(\Doctrine\Common\Util\Debug::dump($artiste));

      return $this->render('HZWonja237Bundle:ArtistePublic:categoryArtiste.html.twig', array('artiste' => $artiste, 'name' => $name));
    }

    public function categoryAction()
    {
      $em = $this->getDoctrine()->getManager();

      $category= $em->getRepository('HZWonja237Bundle:Category')->findAll();

        return $this->render('HZWonja237Bundle:ArtistePublic:category.html.twig', array('category' => $category));
      }




public function profileAction($id, Request $request)
{

  $comment = new Commentaire();
  $form = $this->createForm(CommentaireType::class, $comment);
  $em = $this->getDoctrine()->getManager();

  $form->handleRequest($request);
          if ($form->isSubmitted() && $form->isValid()) {

              $artiste = $em->getRepository('HZWonja237Bundle:Artiste')->findOneBy(array('id' => $id));
              $comment->setArtiste($artiste);
              $em->persist($comment);
              $em->flush();
              //$request->getSession()->getFlashbag()->add('success','Bien jouer!');


              $flashBag = $this->get('session')->getFlashBag();
$flashBag->get('user-notice'); // gets message and clears type
$flashBag->set('user-notice', 'Votre commantaire a ete enregistrer avec success!');

          }




  $artiste = $em->getRepository('HZWonja237Bundle:Artiste')->find($id);
  $category = $em->getRepository('HZWonja237Bundle:Category')->findAll();
  $commentaire =  $em->getRepository('HZWonja237Bundle:Artiste')->getArtisteAvecCommentaires();
  shuffle($commentaire);

  return $this->render('HZWonja237Bundle:ArtistePublic:profile.html.twig', array('form'=>$form->createView(), 'artiste' => $artiste,  'category' => $category, 'commentaire' => $commentaire));
}

public function reservationAction($id, Request $request, $name){
  $reservation = new Reservation();
  $form = $this->createForm(ReservationType::class, $reservation);

  $em = $this->getDoctrine()->getManager();

  $form->handleRequest($request);
          if ($form->isSubmitted() && $form->isValid()) {

              $artiste = $em->getRepository('HZWonja237Bundle:Artiste')->findOneBy(array('id' => $id));
              $reservation->setArtiste($artiste);
              $em->persist($reservation);
              $em->flush();
              //$request->getSession()->getFlashbag()->add('success','Bien jouer!');


              $flashBag = $this->get('session')->getFlashBag();
  $flashBag->get('user-notice'); // gets message and clears type
  $flashBag->set('user-notice', 'Votre reservation a ete Enregistrer avec success!');

$message = \Swift_Message::newInstance()
          ->setSubject('Validation de votre Reservation!')
          ->setFrom(array('hubertoz@yahoo.fr' => "Wonja237"))
          ->setTo('hubertoz@yahoo.fr')
          ->setCharset('utf-8')
          ->setContentType('text/html')
          ->setBody($this->renderView('HZWonja237Bundle:ArtistePublic:swiftLayout.html.twig'));

          $this->get('mailer')->send($message);
          }

  return $this->render('HZWonja237Bundle:ArtistePublic:reservation.html.twig', array('form'=>$form->createView(), 'artiste' => $reservation, 'name' => $name));

}


public function enregistremenArtisteAction(Request $request){
  $enregistrement = new Enregistrement();
  $form = $this->createForm(EnregistrementType::class, $enregistrement);


  $em = $this->getDoctrine()->getManager();
  $form->handleRequest($request);
          if ($form->isSubmitted() && $form->isValid()) {
              $em->persist($enregistrement);
              $em->flush();
  $flashBag = $this->get('session')->getFlashBag();
  $flashBag->get('user-notice'); // gets message and clears type
  $flashBag->set('user-notice', 'Vous avez etet Enregistrer avec success!');
}
  return $this->render('HZWonja237Bundle:ArtistePublic:enregistremenArtiste.html.twig', array('form'=>$form->createView()));

}


public function contactAction(Request $request){
  $contact = new Contact();
  $form = $this->createForm(ContactType::class, $contact);


  $em = $this->getDoctrine()->getManager();
  $form->handleRequest($request);
          if ($form->isSubmitted() && $form->isValid()) {
              $em->persist($contact);
              $em->flush();
  $flashBag = $this->get('session')->getFlashBag();
  $flashBag->get('user-notice'); // gets message and clears type
  $flashBag->set('user-notice', '!! Nous vous remercions !!');
}
  return $this->render('HZWonja237Bundle:ArtistePublic:contact.html.twig', array('form'=>$form->createView()));

}
}
