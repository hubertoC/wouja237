<?php
namespace HZ\Wonja237Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Cookie;
use HZ\Wonja237Bundle\Entity\starratingsystem;

class AjaxStarratingsystemController extends Controller
{
    public function updateDataAction(Request $request)
    {
        $mediaId = $request->get('mediaId');
        $rate = $request->get('rate');

        $em = $this->getDoctrine()->getManager();

        $rateExists = $em->createQuery('SELECT s.id FROM HZWonja237Bundle:starratingsystem s WHERE s.media = :media')
                ->setParameter('media', $mediaId)
                ->getResult();

        if ($rateExists != null) {
            $q = $em->createQuery('UPDATE HZWonja237Bundle:starratingsystem s SET s.rate = s.rate + '.$rate.', s.nbrrate = s.nbrrate + 1 WHERE s.media = ?1')
                ->setParameter(1, $mediaId);
            $q->execute();
        } else {
            $newRate = new starratingsystem;
            $newRate->setMedia($mediaId);
            $newRate->setRate($rate);
            $newRate->setNbrrate(1);
            $em->persist($newRate);
            $em->flush();
        }

        $query = $em->createQuery('SELECT s.rate, s.nbrrate FROM HZWonja237Bundle:starratingsystem s WHERE s.media = :media')
                ->setParameter('media', $mediaId);
        $result = $query->getResult();

        $response = new JsonResponse();
        $response->setData(array('avg' => round($result[0]['rate'] / $result[0]['nbrrate'], 2), 'nbrRate' => $result[0]['nbrrate']));
        return $response;
    }
}
