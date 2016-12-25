<?php

namespace PricerBundle\Controller;

use PricerBundle\Entity\Supplier;
use PricerBundle\Form\SupplierForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SupplierController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Pricer/supplier/index.html.twig');
    }

    public function showSupplierAction($supplierId)
    {
        $response = null;
        $repository = $this->getDoctrine()->getRepository('PricerBundle:Supplier');
        if ($supplierId == 'all') {
            $suppliers = $repository->findBy(array('user' => $this->getUser()));
            $response = $this->render('@Pricer/supplier/show/showAll.html.twig', array(
                'suppliers' => $suppliers,
            ));
        } else {
            $supplier = $repository->find((int)$supplierId);
            if (!$supplier) {
                throw $this->createNotFoundException('Такого поставщика не существует!');
            }
            $response = $this->render('@Pricer/supplier/show/show.html.twig', array(
                'supplier' => $supplier,
            ));
        }

        return $response;
    }

    public function addAction(Request $request)
    {
        $supplier = new Supplier();
        $form = $this->createForm(SupplierForm::class, $supplier, array(
            'action' => $this->generateUrl('pricer_addSupplier'),
        ));
        $supplierErrors = array();
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            $validator = $this->get('validator');
            $supplier->setUser($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($supplier);
            $errors = $validator->validate($supplier);

            if (count($errors) == 0) {
                $em->flush();

                return $this->redirectToRoute(
                    'pricer_showSupplier',
                    array(
                        'supplierId' => $supplier->getId()
                    )
                );
            } else {
                foreach ($errors as $error) {
                    $supplierErrors[$error->getPropertyPath()] = $error->getMessage();
                }
            }
        }

        return $this->render('@Pricer/supplier/form/add_supplier_form.html.twig', array(
            'form'   => $form->createView(),
            'errors' => $supplierErrors
        ));
    }
}
