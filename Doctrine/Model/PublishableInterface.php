<?php

namespace Umanit\ContentPublicationBundle\Doctrine\Model;

/**
 * @author Arthur Guigand <aguigand@umanit.fr>
 */
interface PublishableInterface
{
    /**
     * @return \DateTime
     */
    public function getPublishDate();

    /**
     * @param \DateTime $publishDate
     *
     * @return $this
     */
    public function setPublishDate(\DateTime $publishDate = null);
}
