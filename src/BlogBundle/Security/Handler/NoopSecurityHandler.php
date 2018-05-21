<?php

namespace BlogBundle\Security\Handler;

use Sonata\AdminBundle\Admin\AdminInterface;


class NoopSecurityHandler implements SecurityHandlerInterface
{
    public function isGranted(AdminInterface $admin, $attributes, $object = null)
    {
        return true;
    }

    public function getBaseRole(AdminInterface $admin)
    {
        return '';
    }

    public function buildSecurityInformation(AdminInterface $admin)
    {
        return [];
    }

    public function createObjectSecurity(AdminInterface $admin, $object)
    {
    }

    public function deleteObjectSecurity(AdminInterface $admin, $object)
    {
    }
}
