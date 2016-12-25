<?php

namespace PricerBundle\Controller;

use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use PricerBundle\Entity\BrandRuler;
use PricerBundle\Entity\VendorCodeRuler;
use PricerBundle\Form\AddBrandRulerSimpleForm;
use PricerBundle\Form\AddVendorCodeRulerForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class RulerController extends Controller
{
    public function indexAction($priceListId)
    {
        $priceList = $this->getDoctrine()->getRepository('PricerBundle:PriceList')->findOneBy(array(
            'user' => $this->getUser(),
            'id'   => $priceListId,
        ));

        if (!$priceList) {
            throw $this->createNotFoundException('Такого прайслиста не существует или у вас нету прав для просмотра этого прайслиста!');
        }
        return $this->render('@Pricer/ruler/index.html.twig', array(
            'priceList' => $priceList,
        ));
    }

    public function showBrandRulersAction($priceListId)
    {
        $em = $this->getDoctrine();
        $priceList = $em->getRepository('PricerBundle:PriceList')->findOneBy(array(
            'user' => $this->getUser(),
            'id'   => $priceListId,
        ));

        if (!$priceList) {
            throw $this->createNotFoundException('Такого прайслиста не существует или у вас нету прав для просмотра этого прайслиста!');
        }

        $brandRulers = $em->getRepository('PricerBundle:BrandRuler')->findBy(array(
            'supplier' => $priceList->getSupplier(),
        ));

        return $this->render('@Pricer/ruler/brand/show/showBrandsRulers.html.twig', array(
            'priceList'   => $priceList,
            'brandRulers' => $brandRulers,
        ));
    }

    public function addBrandRulerAction($priceListId, Request $request)
    {
        $doctrine = $this->getDoctrine();
        $priceList = $doctrine->getRepository('PricerBundle:PriceList')->findOneBy(array(
            'id'   => $priceListId,
            'user' => $this->getUser(),
        ));
        if (!$priceList) {
            throw $this->createNotFoundException('Такого прайслиста не существует или у вас нету прав для просмотра этого прайслиста!');
        }

        $brandRuler = new BrandRuler();
        $form = $this->createForm(AddBrandRulerSimpleForm::class, $brandRuler, array(
            'action' => $this->generateUrl('pricer_ruler_brand_add', array('priceListId' => $priceList->getId()))
        ));
        $brandErrors = array();
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            $brandRuler->setSupplier($priceList->getSupplier());
            $doctrine->getManager()->persist($brandRuler);

            $errors = $this->get('validator')->validate($brandRuler);
            if (count($errors) == 0) {
                $doctrine->getManager()->flush();
            } else {
                foreach ($errors as $error) {
                    $brandErrors[$error->getPropertyPath()] = $error->getMessage();
                }
            }
        }
        return $this->render('@Pricer/ruler/brand/add/form/addBrandRulerSimpleForm.html.twig', array(
            'form'      => $form->createView(),
            'priceList' => $priceList,
            'errors'    => $brandErrors,
        ));
    }

    public function showVendorCodeRulerAction($priceListId)
    {
        $doctrine = $this->getDoctrine();
        $priceList = $doctrine->getRepository('PricerBundle:PriceList')->findOneBy(array(
            'id'   => $priceListId,
            'user' => $this->getUser(),
        ));
        if (!$priceList) {
            throw $this->createNotFoundException('Такого прайслиста не существует или у вас нету прав для просмотра этого прайслиста!');
        }

        $vendorCodeRulers = $doctrine->getRepository('PricerBundle:VendorCodeRuler')->findBy(array(
            'supplier' => $priceList->getSupplier(),
        ));
        return $this->render('@Pricer/ruler/vendor/show/showVendorCodeRuler.html.twig', array(
            'priceList'        => $priceList,
            'vendorCodeRulers' => $vendorCodeRulers,
        ));
    }

    public function addVendorCodeRulerAction($priceListId, Request $request)
    {
        $doctrine = $this->getDoctrine();
        $priceList = $doctrine->getRepository('PricerBundle:PriceList')->findOneBy(array(
            'id'   => $priceListId,
            'user' => $this->getUser(),
        ));
        if (!$priceList) {
            throw $this->createNotFoundException('Такого прайслиста не существует или у вас нету прав для просмотра этого прайслиста!');
        }
        $vendorCodeRuler = new VendorCodeRuler();
        $form = $this->createForm(AddVendorCodeRulerForm::class, $vendorCodeRuler, array(
            'action' => $this->generateUrl('pricer_ruler_vendorCode_add', array(
                'priceListId' => $priceList->getId()
            ))
        ));
        $vendorCodeRulerErrors = array();
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            $vendorCodeRuler->setSupplier($priceList->getSupplier());
            $doctrine->getManager()->persist($vendorCodeRuler);
            $errors = $this->get('validator') ->validate($vendorCodeRuler);
            if (count($errors) == 0) {
                $doctrine->getManager()->flush();
            } else {
                foreach ($errors as $error) {
                    $vendorCodeRulerErrors[$error->getPropertyPath()] = $error->getMessage();
                }
            }
        }
        return $this->render('@Pricer/ruler/vendor/add/form/addVendorCodeRulerForm.html.twig', array(
            'form'      => $form->createView(),
            'priceList' => $priceList,
            'errors'    => $vendorCodeRulerErrors,
        ));
    }
}