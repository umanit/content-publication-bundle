<?php

namespace Umanit\ContentPublicationBundle\Doctrine\Model;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author Arthur Guigand <aguigand@umanit.fr>
 */
trait PublishableTrait
{
    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", name="publish_date", nullable=true)
     * @Assert\NotBlank()
     * @Assert\DateTime()
     */
    protected $publishDate;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", name="unpublish_date", nullable=true)
     * @Assert\DateTime()
     * @Assert\Expression(
     *     expression="this.getUnpublishDate() == null or this.getUnpublishDate() > this.getPublishDate()",
     *     message="The unpublish date must be greater than the publish date"
     * )
     */
    protected $unpublishDate;

    /**
     * PublishableTrait constructor.
     */
    public function __construct()
    {
        $this->publishDate = new \DateTime();
    }

    /**
     * @return \DateTime
     */
    public function getPublishDate()
    {
        return $this->publishDate;
    }

    /**
     * @param \DateTime $publishDate
     *
     * @return $this
     */
    public function setPublishDate(\DateTime $publishDate = null)
    {
        $this->publishDate = $publishDate;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUnpublishDate()
    {
        return $this->unpublishDate;
    }

    /**
     * @param \DateTime $unpublishDate
     *
     * @return $this
     */
    public function setUnpublishDate(\DateTime $unpublishDate = null)
    {
        $this->unpublishDate = $unpublishDate;

        return $this;
    }

    /**
     * Defines if the content is published.
     *
     * @return bool
     */
    public function isPublished()
    {
        $now = new \DateTime();

        return
            (null === $this->getUnpublishDate() && $this->getPublishDate() <= $now) ||
            ($now <= $this->getUnpublishDate() && $this->getPublishDate() <= $now);
    }

}
