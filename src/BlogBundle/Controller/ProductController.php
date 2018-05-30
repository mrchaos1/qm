<?php

namespace BlogBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class ProductController extends Controller
{


    public function productsAction()
    {
        return $this->render('@Blog/QMTheme/product/products.twig.html');
    }

}
