<?php

namespace BMG\BookToolBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use BMG\BookToolBundle\Controller\CommonController;
use BMG\BookToolBundle\Entity\UserRecoveryPasswordHash;

/**
 * Email controller.
 *
 */
class EmailController extends Controller
{

    /**
     * Lists all Book entities.
     *
     */
    public function indexAction(Request $request, $process = NULL)
    {

        $session = $this->getRequest()->getSession();

        $common = $this->get('Common');
        $common->checkSessionAction();

        //Getting current user information
        $user = $session->get('user');
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository("BMGBookToolBundle:User")->find($user->getUserId());

        //ONLY ADMINs :)
        if(!$user->getUserAdmin()) die('You are not authorized to be here. This event has been recorded successfully');

        //Getting the email to send
        switch($process) {
            case "invitation":
                echo "Procesing Invitation Email<br>";
                $this->_invitationEmail($request);
                break;
        }

        echo "Hello " . $user->getUserFirstname() . " ... you should know what to do.";

        exit;

    }

    private function _invitationEmail($request) {

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('BMGBookToolBundle:User')->findBy(array('status'=>8));
        $common = $this->get('Common');

        if($entity) {
            echo "<br><p>Sending invitation email to: </p>";


            foreach($entity as $value) {


                $currentHash = $em->getRepository('BMGBookToolBundle:UserRecoveryPasswordHash')->findOneBy(array('user' => $value));
                if($currentHash) {

                    $hash = $currentHash->getUserRecoveryPasswordHashValue();
                    $hash = str_replace("/", "*", $hash);

                }else {

                    echo $value->getUserEmail() . "<br>";

                    $userRecoveryPassword = new UserRecoveryPasswordHash();
                    $userRecoveryPassword->setUser($value);
                    $hash = password_hash($value->getUserId() . $value->getUserEmail(), PASSWORD_DEFAULT);
                    $hash = str_replace("/", "*", $hash);
                    $userRecoveryPassword->setUserRecoveryPasswordHashValue($hash);

                    $em->persist($userRecoveryPassword);
                    $em->flush();

                }

                try{
                    $parameters = array(
                        'user_fullname' => $value->getUserFirstname() . ' ' . $value->getUserLastname(),
                        'user_email' => $value->getUserEmail(),
                        'url' => $this->container->getParameter('site_url'),
                        'hash' => $hash
                    );
                    $common->sendMail($value->getUserEmail(),
                        $this->get('translator')->trans("email_invitation_subject", array(), "email", $request->getLocale()),
                        'BMGBookToolBundle:Email:email_invitation.html.twig',
                        null,
                        true,
                        $parameters);
                }
                catch (\Exception $exc){
                    echo("Error. Email not send" . $exc->getMessage());
                }


            }

            echo "<hr>All done.";
        }

        exit;
    }


}
