<?php

namespace Umanit\ContentPublicationBundle\EventSubscriber;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security\FirewallConfig;
use Symfony\Bundle\SecurityBundle\Security\FirewallMap;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Csrf\TokenStorage\TokenStorageInterface;
use Symfony\Component\Security\Http\Firewall;

/**
 * The PublishFilterSubscriber disables the PublishFilter based on the config
 * umanit_content_publication.disabled_firewalls
 *
 * @author Arthur Guigand <aguigand@umanit.fr>
 */
class PublishFilterSubscriber implements EventSubscriberInterface
{
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var array
     */
    private $disabledFirewalls;

    /**
     * @var FirewallMap
     */
    private $firewallMap;

    /**
     * PublishFilterSubscriber constructor.
     *
     * @param TokenStorageInterface  $tokenStorage
     * @param EntityManagerInterface $em
     * @param FirewallMap            $firewallMap
     * @param array                  $disabledFirewalls
     */
    public function __construct(
        TokenStorageInterface $tokenStorage,
        EntityManagerInterface $em,
        FirewallMap $firewallMap,
        $disabledFirewalls
    ) {
        $this->tokenStorage = $tokenStorage;
        $this->em = $em;
        $this->disabledFirewalls = $disabledFirewalls;
        $this->firewallMap = $firewallMap;
    }

    /**
     * {@inheritdoc}
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [KernelEvents::REQUEST => 'onKernelRequest'];
    }

    /**
     * @param GetResponseEvent $event
     */
    public function onKernelRequest(GetResponseEvent $event)
    {
        // Disable the publish filter if user is admin
        if ($this->isDisabledFirewall($event->getRequest())) {
            if ($this->em->getFilters()->isEnabled('umanit_publishable_filter')) {
                $this->em->getFilters()->disable('umanit_publishable_filter');
            }
        }
    }

    /**
     * Indicates if the current firewall should disable the filter.
     *
     * @param Request $request
     *
     * @return bool
     */
    protected function isDisabledFirewall(Request $request)
    {
        if (null === $this->firewallMap->getFirewallConfig($request)) {
            return false;
        }

        return in_array($this->firewallMap->getFirewallConfig($request)->getName(), $this->disabledFirewalls);
    }
}
