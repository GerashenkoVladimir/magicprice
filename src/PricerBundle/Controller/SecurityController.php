<?php

namespace PricerBundle\Controller;

use PricerBundle\Entity\User;
use PricerBundle\Form\UserLoginForm;
use PricerBundle\Form\UserRegistrationForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SecurityController extends Controller
{
    public function loginAction()
    {
        $form = $this->createForm(UserLoginForm::class, null, array(
            'action' => $this->generateUrl('pricer_user_login'),
        ));
        $authenticationUtils = $this->get('security.authentication_utils');

        $error = $authenticationUtils->getLastAuthenticationError();

        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('@Pricer/security/loginForm.html.twig', array(
            'last_username' => $lastUsername,
            'error' => $error,
            'form' => $form->createView()
            )
        );
    }

    public function registrationAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm(UserRegistrationForm::class, $user, array(
            'action' => $this->generateUrl('pricer_user_registration'),
        ));
        $form->handleRequest($request);
        $userErrors = array();
        if ($request->isMethod('POST')) {
            $validator = $this->get('validator');
            $errors = $validator->validate($user);
            if (count($errors) == 0){
                $em = $this->getDoctrine()->getManager();
                $encodedPassword = $this->get('security.password_encoder')->encodePassword($user, $user->getPassword());
                $user->setPassword($encodedPassword);
                
                $em->persist($user);
                $em->flush();
                return $this->redirectToRoute('pricer_homepage');
            } else {
                foreach ($errors as $error) {
                    $userErrors[$error->getPropertyPath()] = $error->getMessage();
                }
            }
        }
        return $this->render('@Pricer/security/registrationForm.html.twig', array(
            'form' => $form->createView(),
            'errors' => $userErrors,
        ));
    }
}
