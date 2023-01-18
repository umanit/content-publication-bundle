<?php

namespace Umanit\ContentPublicationBundle\EventSubscriber;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security\FirewallMap;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * The PublishFilterSubscriber disables the PublishFilter based on the config
 * umanit_content_publication.disabled_firewalls
 */
class PublishFilterSubscriber implements EventSubscriberInterface
{
    private EntityManagerInterface $em;
    private array $disabledFirewalls;
    private FirewallMap $firewallMap;

    public function __construct(
        EntityManagerInterface $em,
        FirewallMap $firewallMap,
        $disabledFirewalls
    ) {
        $this->em = $em;
        $this->disabledFirewalls = $disabledFirewalls;
        $this->firewallMap = $firewallMap;
    }

    public static function getSubscribedEvents()
    {
        return [KernelEvents::REQUEST => 'onKernelRequest'];
    }

    public function onKernelRequest(RequestEvent $event)
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
    protected function isDisabledFirewall(Request $request): bool
    {
        if (null === $this->firewallMap->getFirewallConfig($request)) {
            return false;
        }

        return in_array($this->firewallMap->getFirewallConfig($request)->getName(), $this->disabledFirewalls);
    }
}
