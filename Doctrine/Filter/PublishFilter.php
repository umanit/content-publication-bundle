<?php

namespace Umanit\ContentPublicationBundle\Doctrine\Filter;

use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Query\Filter\SQLFilter;
use Umanit\ContentPublicationBundle\Doctrine\Model\PublishableInterface;

/**
 * Filters translatable contents by the current locale.
 */
class PublishFilter extends SQLFilter
{
    public function addFilterConstraint(ClassMetadata $targetEntity, $targetTableAlias): string
    {
        // If the entity is a PublishableInterface
        if (in_array(PublishableInterface::class, $targetEntity->getReflectionClass()->getInterfaceNames())) {
            $now = new \DateTime();
            $publishDateCol = $targetEntity->fieldMappings['publishDate']['columnName'];
            $unpublishDateCol = $targetEntity->fieldMappings['unpublishDate']['columnName'];

            return strtr(
                "%table%.%publishDate% IS NULL OR (%table%.%publishDate% <= '%now%' AND (%table%.%unpublishDate% IS NULL OR %table%.%unpublishDate% > '%now%'))",
                [
                    '%table%'         => $targetTableAlias,
                    '%now%'           => $now->format('Y-m-d H:i:s'),
                    '%publishDate%'   => $publishDateCol,
                    '%unpublishDate%' => $unpublishDateCol,
                ]
            );
        }

        return '';
    }
}
