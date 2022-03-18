<?php

declare(strict_types=1);

namespace Arobases\SyliusRightsManagementPlugin\Access\Listener;


use Arobases\SyliusRightsManagementPlugin\Access\Checker\AdminRouteChecker;
use Arobases\SyliusRightsManagementPlugin\Access\Checker\AdminUserAccessChecker;
use Sylius\Component\Core\Model\AdminUserInterface;

use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\User\UserInterface;


class AccessCheckListener
{
    private TokenStorageInterface $tokenStorage;
    private AdminUserAccessChecker $adminUserAccessChecker;
    private AdminRouteChecker $adminRouteAccessChecker;

    /**
     * AccessCheckListener constructor.
     * @param TokenStorageInterface $tokenStorage
     * @param AdminUserAccessChecker $adminUserAccessChecker
     * @param AdminRouteChecker $adminRouteAccessChecker
     */
    public function __construct(TokenStorageInterface $tokenStorage, AdminUserAccessChecker $adminUserAccessChecker, AdminRouteChecker $adminRouteAccessChecker)
    {
        $this->tokenStorage = $tokenStorage;
        $this->adminUserAccessChecker = $adminUserAccessChecker;
        $this->adminRouteAccessChecker = $adminRouteAccessChecker;
    }


    public function onKernelRequest(RequestEvent $event): void
    {

        $routeName = $event->getRequest()->get('_route');
        if(strpos($routeName, 'partial')){
            return ;
        }

//        dump( $event->getRequest());
//        dump($routeName);


        if(null === $routeName ){
            return ;
        }
        $routeSection = $event->getRequest()->attributes->get('_sylius')['section'];

        if(!$this->adminRouteAccessChecker->isAdminRoute($routeName, $routeSection)) {
            return ;
        }

        $adminUser = $this->getCurrentAdminUser();
        if ($adminUser instanceof AdminUserInterface && $adminUser->getRole())
        {
            $this->adminUserAccessChecker->isUserGranted($adminUser, $routeName);
        }
//        try {
//            dump("cc");
//            exit;
////            $accessRequest = $this->createAccessRequestFromEvent($event);
//        } catch (InsecureRequestException $exception) {
//            return;
//        }
//
//        if ($this->administratorAccessChecker->canAccessSection($this->getCurrentAdmin(), $accessRequest)) {
//            return;
//        }
//
//        $this->addAccessErrorFlash($event->getRequest()->getMethod());
//        $event->setResponse($this->getRedirectResponse($event->getRequest()->headers->get('referer')));
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
}

