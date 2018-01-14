<?php
namespace App\Security\Google;

use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
//use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

class RequestListener
{

    /**
     * @var \App\Security\Google\Helper $helper
     */
    protected $helper;

    /**
     * @var \Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken $securityContext
     */
    protected $securityContext;

    /**
     * @var \Symfony\Bundle\FrameworkBundle\Templating\EngineInterface $templating
     */
    protected $templating;

    /**
     * @param \App\Security\Google\Helper    $helper
     * @param \Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage $securityContext
     * @param \Symfony\Bundle\FrameworkBundle\Templating\EngineInterface $templating
     */
    public function __construct(Helper $helper, UsernamePasswordToken $securityContext, EngineInterface $templating)
    {
        $this->helper = $helper;
        $this->securityContext = $securityContext;
        $this->templating = $templating;
    }

    /**
     * @param \Symfony\Component\HttpKernel\Event\GetResponseEvent $event
     * @return
     */
    public function onCoreRequest(GetResponseEvent $event)
    {
        $token = $this->securityContext->getToken();

        if (!$token)
        {
            return;
        }

        if (!$token instanceof UsernamePasswordToken)
        {
            return;
        }

        $key = $this->helper->getSessionKey($this->securityContext);
        $request = $event->getRequest();
        $session = $event->getRequest()->getSession();
        $user = $this->securityContext->getToken()->getUser();

        //Check if user has to do two-factor authentication
        if (!$session->has($key))
        {
            return;
        }
        if ($session->get($key) === true)
        {
            return;
        }

        if ($request->getMethod() == 'POST')
        {
            //Check the authentication code
            if ($this->helper->checkCode($user, $request->get('_auth_code')) == true)
            {
                //Flag authentication complete
                $session->set($key, true);

                //Redirect to user's dashboard
                $redirect = new RedirectResponse($this->router->generate("user_dashboard"));
                $event->setResponse($redirect);
                return;
            }
            else
            {
                $session->getFlashBag()->set("error", "The verification code is not valid.");
            }
        }

        //Force authentication code dialog
        $response = $this->templating->renderResponse('AcmeUserBundle:TwoFactor:google.html.twig');
        $event->setResponse($response);
    }

}