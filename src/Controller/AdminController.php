<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use App\Form\AdminEditRolesType;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminController
 * @package App\Controller
 * @IsGranted("ROLE_ADMIN")
 */
class AdminController extends AbstractController
{

    /**
     * List of users
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/users", name="user_list")
     */
    public function listUserAction()
    {
        $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->findAll();

        return $this->render('admin/userlist.html.twig', ['user' => $user]);
    }

    /**
     * Edit the roles of users
     * @param Request $request
     * @param User $user
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Route("/admin/editroles/{user}", name="admin_edit_roles")
     */
    public function adminEditRolesAction(Request $request, User $user)
    {
        if (!$user) {
            throw $this->createNotFoundException(
                'No user found for article ' . $user
            );
        }

        $form = $this->createForm(AdminEditRolesType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            $this->addFlash('success', 'Success');

            $this->redirectToRoute('user_list');
        }
        return $this->render('admin/roles.html.twig', array(
            'form' => $form->createView(),
            'user' => $user
        ));
    }
}
