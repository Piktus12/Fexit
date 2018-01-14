<?php
namespace App\Security\Google;

use Google\Authenticator\GoogleAuthenticator as BaseGoogleAuthenticator;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class Helper
{
    /**
     * @var string $server
     */
    protected $server;

    /**
     * @var \Google\Authenticator\GoogleAuthenticator $authenticator
     */
    protected $authenticator;

    /**
     * Construct the helper service for Google Authenticator
     * @param string $server
     * @param \Google\Authenticator\GoogleAuthenticator $authenticator
     */
    public function __construct($server, BaseGoogleAuthenticator $authenticator)
    {
        $this->server = $server;
        $this->authenticator = $authenticator;
    }

    /**
     * Validates the code, which was entered by the user
     * @param \App\Entity\User $user
     * @param $code
     * @return bool
     */
    public function checkCode(User $user, $code)
    {
        return $this->authenticator->checkCode($user->getGoogleAuthenticatorCode(), $code);
    }

    /**
     * Generate the URL of a QR code, which can be scanned by Google Authenticator app
     * @param \App\Entity\User $user
     * @return string
     */
    public function getUrl(User $user)
    {
        return $this->authenticator->getUrl($user->getUsername(), $this->server, $user->getGoogleAuthenticatorCode());
    }

    /**
     * Generate a new secret for Google Authenticator
     * @return string
     */
    public function generateSecret()
    {
        return $this->authenticator->generateSecret();
    }

    /**
     * Generates the attribute key for the session
     * @param \Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken $token
     * @return string
     */
    public function getSessionKey(UsernamePasswordToken $token)
    {
        return sprintf('acme_google_authenticator_%s_%s', $token->getProviderKey(), $token->getUsername());
    }

}