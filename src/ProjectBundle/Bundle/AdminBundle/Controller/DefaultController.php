<?php

namespace ProjectBundle\Bundle\AdminBundle\Controller;

class DefaultController extends BaseController
{
    public function indexAction()
    {
        return $this->render('ProjectBundleAdminBundle:Default:index.html.twig');
    }
}
