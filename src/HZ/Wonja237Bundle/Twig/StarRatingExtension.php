<?php
namespace HZ\Wonja237Bundle\Twig;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Cookie;
 use Symfony\Component\HttpFoundation\RequestStack;
class StarRatingExtension extends \Twig_Extension
{
    protected $doctrineMysql;
    private $requestStack;

    public function __construct(\Doctrine\ORM\EntityManager $doctrine, RequestStack $RequestStack)
    {
        $this->doctrineMysql = $doctrine;
        $this->requestStack = $RequestStack;
    }

    public function getFunctions() {
      return array(
           'starBar' => new \Twig_Function_Method($this, 'myStarBar'),
      );
    }

    public function myStarBar($numStar, $mediaId, $starWidth) {

        $cookies = $this->requestStack->getCurrentRequest()->cookies->get('symfonyRatingSystem'.$mediaId);

        $nbrPixelsInDiv = $numStar * $starWidth; // Calculate the DIV width in pixel


        $query = $this->doctrineMysql->getRepository('HZWonja237Bundle:starratingsystem')->findOneBy(array('media' => $mediaId));

        if (isset($query)) {
        $average = round($query->getRate()/$query->getNbrrate(), 2);
        $nbrRate = $query->getNbrrate();
        } else {
            $average = 0;
            $nbrRate = 0;
        }

        //num of pixel to colorize (in yellow)
        $numEnlightedPX = round($nbrPixelsInDiv * $average / $numStar, 0);

        $getJSON = array('numStar' => $numStar, 'mediaId' => $mediaId); // We create a JSON with the number of stars and the media ID
        $getJSON = json_encode($getJSON);

        $starBar = '<div id="group'.$mediaId.'">';
        $starBar .= '<div class="star_bar" style="width:'.$nbrPixelsInDiv.'px;  height:'.$starWidth.'px; background: linear-gradient(to right, #ffc600 0px,#ffc600 '.$numEnlightedPX.'px,#ccc '.$numEnlightedPX.'px,#ccc '.$nbrPixelsInDiv.'px);" rel='.$getJSON.'>';
        for ($i=1; $i<=$numStar; $i++) {
            $starBar .= '<div title="'.$i.'/'.$numStar.'" id="'.$i.'" class="star"';
            if( !$cookies )
                    $starBar .= ' onmouseover="overStar('.$mediaId.', '.$i.', '.$numStar.');" onmouseout="outStar('.$mediaId.', '.$i.', '.$numStar.');" onclick="rateMedia('.$mediaId.', '.$i.', '.$numStar.', '.$starWidth.');"';
            $starBar .= '></div>';
        }
        $starBar .= '</div>';
        $starBar .= '<div class="resultMedia'.$mediaId.'" style="font-size: small; color: grey">'; // We show the rate score and number of rates
        if (!isset($query)) $starBar .= 'Pas encore de vote';
        else $starBar .= 'Note: ' . $average . '/' . $numStar . ' (' . $nbrRate . ' votes)';
        $starBar .= '</div>';
        $starBar .= '<div class="box'.$mediaId.'"></div>';
        $starBar .= '</div>';

        return $starBar;
   }

   public function getName()
    {
        return 'StarRating_extension';
    }
}
