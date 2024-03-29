<?php

namespace Umanit\ContentPublicationBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @link http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class UmanitContentPublicationExtension extends Extension implements PrependExtensionInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        // Set configuration into params
        $rootName = 'umanit_content_publication';
        $container->setParameter($rootName, $config);
        $this->setConfigAsParameters($container, $config, $rootName);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yaml');
    }

    /**
     * {@inheritdoc}
     *
     * @param ContainerBuilder $container
     */
    public function prepend(ContainerBuilder $container)
    {
        $container->prependExtensionConfig('doctrine', [
            'orm' => [
                'filters' => [
                    'umanit_publishable_filter' => [
                        'class'   => 'Umanit\ContentPublicationBundle\Doctrine\Filter\PublishFilter',
                        'enabled' => true,
                    ],
                ],
            ],
        ]);
    }

    /**
     * Add config keys as parameters.
     *
     * @param ContainerBuilder $container
     * @param array            $params
     * @param string           $parent
     */
    private function setConfigAsParameters(ContainerBuilder &$container, array $params, $parent)
    {
        foreach ($params as $key => $value) {
            $name = $parent.'.'.$key;
            $container->setParameter($name, $value);

            if (is_array($value)) {
                $this->setConfigAsParameters($container, $value, $name);
            }
        }
    }
}
