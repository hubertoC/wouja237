<?php

namespace HZ\Wonja237Bundle\Controller;

use HZ\Wonja237Bundle\Entity\Publicites;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class PublicitesController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $publicites = $em->getRepository('HZWonja237Bundle:Publicites')->findAll();

        return $this->render('publicites/index.html.twig', array(
            'publicites' => $publicites,
        ));
    }


    public function newAction(Request $request)
    {
        $publicite = new Publicites();
        $form = $this->createForm('HZ\Wonja237Bundle\Form\PublicitesType', $publicite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($publicite);
            $em->flush();

            return $this->redirectToRoute('publicites_show', array('id' => $publicite->getId()));
        }

        return $this->render('publicites/new.html.twig', array(
            'publicite' => $publicite,
            'form' => $form->createView(),
        ));
    }


    public function showAction(Publicites $publicite)
    {
        $deleteForm = $this->createDeleteForm($publicite);

        return $this->render('publicites/show.html.twig', array(
            'publicite' => $publicite,
            'delete_form' => $deleteForm->createView(),
        ));
    }


    public function editAction(Request $request, Publicites $publicite)
    {
        $deleteForm = $this->createDeleteForm($publicite);
        $editForm = $this->createForm('HZ\Wonja237Bundle\Form\PublicitesType', $publicite);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('publicites_edit', array('id' => $publicite->getId()));
        }

        return $this->render('publicites/edit.html.twig', array(
            'publicite' => $publicite,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }


    public function deleteAction(Request $request, Publicites $publicite)
    {
        $form = $this->createDeleteForm($publicite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($publicite);
            $em->flush();
        }

        return $this->redirectToRoute('publicites_index');
    }

    /**
     * Creates a form to delete a publicite entity.
     *
     * @param Publicites $publicite The publicite entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Publicites $publicite)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('publicites_delete', array('id' => $publicite->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
