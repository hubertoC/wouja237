<?php

namespace HZ\Wonja237Bundle\Controller;

use HZ\Wonja237Bundle\Entity\Artiste;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class ArtisteController extends Controller
{

    public function indexAction()
    {
      if (!$this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
        throw new AccessDeniedException('Accès limité aux auteurs.');
       }
        $em = $this->getDoctrine()->getManager();

        $artistes = $em->getRepository('HZWonja237Bundle:Artiste')->findAll();

        return $this->render('artiste/index.html.twig', array(
            'artistes' => $artistes,
        ));
    }


    public function newAction(Request $request)
    {
      if (!$this->get('security.authorization_checker')->isGranted('ROLE_AUTEUR')) {
        throw new AccessDeniedException('Accès limité aux auteurs.');
       }
        $artiste = new Artiste();
        $form = $this->createForm('HZ\Wonja237Bundle\Form\ArtisteType', $artiste);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($artiste);
            $em->flush();

            return $this->redirectToRoute('adminArtiste_show', array('id' => $artiste->getId()));
        }

        return $this->render('artiste/new.html.twig', array(
            'artiste' => $artiste,
            'form' => $form->createView(),
        ));
    }


    public function showAction(Artiste $artiste)
    {
      if (!$this->get('security.authorization_checker')->isGranted('ROLE_AUTEUR')) {
        throw new AccessDeniedException('Accès limité aux auteurs.');
       }
        $deleteForm = $this->createDeleteForm($artiste);

        return $this->render('artiste/show.html.twig', array(
            'artiste' => $artiste,
            'delete_form' => $deleteForm->createView(),
        ));
    }


    public function editAction(Request $request, Artiste $artiste)
    {
      if (!$this->get('security.authorization_checker')->isGranted('ROLE_AUTEUR')) {
        throw new AccessDeniedException('Accès limité aux auteurs.');
       }
        $deleteForm = $this->createDeleteForm($artiste);
        $editForm = $this->createForm('HZ\Wonja237Bundle\Form\ArtisteType', $artiste);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('adminArtiste_edit', array('id' => $artiste->getId()));
        }

        return $this->render('artiste/edit.html.twig', array(
            'artiste' => $artiste,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }


    public function deleteAction(Request $request, Artiste $artiste)
    {
      if (!$this->get('security.authorization_checker')->isGranted('ROLE_AUTEUR')) {
        throw new AccessDeniedException('Accès limité aux auteurs.');
       }
        $form = $this->createDeleteForm($artiste);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($artiste);
            $em->flush();
        }

        return $this->redirectToRoute('adminArtiste_index');
    }

    /**
     * Creates a form to delete a artiste entity.
     *
     * @param Artiste $artiste The artiste entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Artiste $artiste)
    {
      if (!$this->get('security.authorization_checker')->isGranted('ROLE_AUTEUR')) {
        throw new AccessDeniedException('Accès limité aux auteurs.');
       }
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('adminArtiste_delete', array('id' => $artiste->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }


}
