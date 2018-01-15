<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Form\UserType;
use App\Entity\User;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="default")
     */
    public function index()
    {




        // replace this line with your own code!



        $session = new session();
        $session->start();


        return $this->render('index.html.twig', [ 'path' => str_replace($this->getParameter('kernel.project_dir').'/', '', __FILE__), 'session' => $session ]);
    }


    /**
     * @Route("/verification/{key}", name="verification")
     */
    public function verificationKey(Request $request, $key)
    {
        // replace this line with your own code!
        $session = $request->getSession();
        if($session == null)
        {
            $session = new session();
            $session->start();
        }

        $user = $this->getDoctrine()->getRepository(user::class)->findOneBy(['verification_key' => $key]);
        if($user != null)
        {
            $em = $this->getDoctrine()->getManager();
            $user->setValid(true);
            $em->persist($user);
            $em->flush();

            $session->getFlashBag()->add('notice',"Verification OK, Account enabled !");
        }
        else
        {
            $session->getFlashBag()->add('error ',"Verification NOK, Invalid Verification link !");
        }




        return $this->render('index.html.twig', [ 'path' => str_replace($this->getParameter('kernel.project_dir').'/', '', __FILE__), 'session' => $session ]);
    }

    /**
     * @Route("/signup", name="signup")
     */
    public function signup(Request $request, UserPasswordEncoderInterface $passwordEncoder,\Swift_Mailer $mailer)
    {


        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $passwordEncoder->encodePassword($user, $user->getPassword());
            $user->setPassword($password);


            //generate unique ID for API_Key

            $key = md5(uniqid());
            $user->setVerificationKey($key);
            $user->setGoogleAuthenticatorCode('null');


            // 4) save the User!
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user
            $message = (new \Swift_Message('Hello Email'))
                ->setFrom('registration@tsaf-paris.com')
                ->setTo($user->getEmail())
                ->setBody(
                    $this->renderView(
                    // templates/emails/registration.html.twig
                        'registration/email.html.twig',
                        array('key' => $user->getVerificationKey())
                    ),
                    'text/html'
                );

            $mailLogger = new \Swift_Plugins_Loggers_ArrayLogger();


            try {
                $mailer->send($message);
            }
            catch (\Swift_TransportException $e) {
                echo $e->getMessage();
            }
            $mailLogger->dump();






            return $this->redirectToRoute('default');
        }

        return $this->render(
            'registration/register.html.twig',
            array('form' => $form->createView())
        );

    }
}
