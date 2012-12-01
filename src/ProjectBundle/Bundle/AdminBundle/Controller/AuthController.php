<?php

namespace ProjectBundle\Bundle\AdminBundle\Controller;

class AuthController extends BaseController
{
    public function loginAction()
    {
        return $this->render('ProjectBundleAdminBundle:Auth:login.html.twig');
    }

    public function signupAction()
    {
        return $this->render('ProjectBundleAdminBundle:Auth:register.html.twig');
    }

    public function localGovAction()
    {
        return $this->render('ProjectBundleAdminBundle:Auth:local_gov_login.html.twig');
    }

    public function localGovDashboardAction()
    {
        return $this->render('ProjectBundleAdminBundle:Auth:dashboard.html.twig');
    }
}