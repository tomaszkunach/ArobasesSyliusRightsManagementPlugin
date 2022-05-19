<?php

declare(strict_types=1);

namespace Arobases\SyliusRightsManagementPlugin\Access\Listener;


use Arobases\SyliusRightsManagementPlugin\Access\Checker\AdminRouteChecker;
use Arobases\SyliusRightsManagementPlugin\Access\Checker\AdminUserAccessChecker;
use Sylius\Component\Core\Model\AdminUserInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\User\UserInterface;


class AccessCheckListener
{
    private TokenStorageInterface $tokenStorage;
    private AdminUserAccessChecker $adminUserAccessChecker;
    private AdminRouteChecker $adminRouteAccessChecker;
    private Session $session;
    private RouterInterface $routeur;

    public function __construct(TokenStorageInterface $tokenStorage, AdminUserAccessChecker $adminUserAccessChecker, AdminRouteChecker $adminRouteAccessChecker, Session $session, RouterInterface $routeur)
    {
        $this->tokenStorage = $tokenStorage;
        $this->adminUserAccessChecker = $adminUserAccessChecker;
        $this->adminRouteAccessChecker = $adminRouteAccessChecker;
        $this->session = $session;
        $this->routeur = $routeur;
    }


    public function onKernelRequest(RequestEvent $event): void
    {
        $routeName = $event->getRequest()->get('_route');

        if(null ===$routeName) {
            return;
        }

        if(strpos($routeName, 'partial') || $routeName === 'sylius_admin_dashboard' || $routeName === 'sylius_admin_login' ) {
            return ;
        }

        if(null === $routeName ){
            return ;
        }

        if(!$this->adminRouteAccessChecker->isAdminRoute($routeName)) {
            return ;
        }
        $adminUser = $this->getCurrentAdminUser();
        if($adminUser->getRole() === null){
            $event->setResponse( $this->redirectUser($this->getRedirectRoute(), $this->getRedirectMessage()));
        }

        if ($adminUser instanceof AdminUserInterface && $adminUser->getRole()) {
            $isUserGranted = $this->adminUserAccessChecker->isUserGranted($adminUser, $routeName);
            if(!$isUserGranted){
                $event->setResponse( $this->redirectUser($this->getRedirectRoute(), $this->getRedirectMessage()));
            }
        }
    }

    private function getCurrentAdminUser(): ?UserInterface
    {
        if(null === $this->tokenStorage->getToken()){
            return null;
        }
        if( null === $this->tokenStorage->getToken()->getUser()){
            return null;
        }
        return $this->tokenStorage->getToken()->getUser();
    }


    private function getRedirectRoute(): string
    {
        return  $this->routeur->generate('sylius_admin_dashboard');
    }

    private  function getRedirectMessage(): string
    {
       return  'arobases_sylius_rights_management.message.access_denied';
    }

    protected function redirectUser(string $route, string $message): RedirectResponse
    {
        $this->session->getFlashBag()->add('error', $message);
        return new RedirectResponse($route);
    }

}

