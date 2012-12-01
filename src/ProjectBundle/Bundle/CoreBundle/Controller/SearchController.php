<?php

namespace ProjectBundle\Bundle\CoreBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class SearchController extends BaseController
{
    public function searchAction()
    {
        print_r($_REQUEST);die;
    }

    /**
     * @Template("ProjectBundle:CoreBundle:Default:index")
     */
    public function getLocationAction($location, $key)
    {
        $template = '';
        switch ($location) {
            case 'district': $response = $this->getDistricts($key);
                             $template = $this->render('ProjectBundleCoreBundle:Search:district.html.twig', $response);
                             break;
            case 'upazila':  $response = $this->getUpazillas($key);
                             $template = $this->render('ProjectBundleCoreBundle:Search:upazila.html.twig', $response);
                             break;
            case 'union':    $response = $this->getUnions($key);
                             $template = $this->render('ProjectBundleCoreBundle:Search:union.html.twig', $response);
                             break;
        }

        return $template;
    }

    public function getDistricts($key)
    {
        $response = array(
            '0' => 'ঢাকা',
            '1' => 'গাজীপুর',
            '2' => 'ময়মনসিংহ',
            '3' => 'জামালপুর',
            '4' => 'শেরপুর'
        );

        return array('districts' => $response);
    }

    public function getUpazillas($key)
    {
        $response = array(
            '0' => 'ময়মনসিংহ সদর',
            '1' => 'ফুলপুর',
            '2' => 'নান্দাইল',
            '3' => 'গৌরীপুর',
            '4' => 'হালুয়াঘাট'
        );

        return array('upazilas' => $response);
    }

    public function getUnions($key)
    {
        $response = array(
            '0' => 'আকুয়া',
            '1' => 'বাড়েরা'
        );

        return array('unions' => $response);
    }
}