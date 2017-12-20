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

    /**
     * @return \DateTime
     */
    public function getUnpublishDate();

    /**
     * @param \DateTime $unpublishDate
     *
     * @return $this
     */
    public function setUnpublishDate(\DateTime $unpublishDate = null);
}
