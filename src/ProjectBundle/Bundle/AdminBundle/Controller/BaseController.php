<?php

namespace ProjectBundle\Bundle\AdminBundle\Controller;

use ProjectBundle\Bundle\CoreBundle\Controller\BaseController as CoreBaseController;

class BaseController extends CoreBaseController
{
    public function isActiveAdminSession()
    {
        //@todo check admin sesssion
    }

    protected function hasPermission($moduleName)
    {
        //@todo check admin access permission
    }
}