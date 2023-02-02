<?php

namespace Umanit\ContentPublicationBundle\Doctrine\Model;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

trait PublishableTrait
{
    /**
     * @var \DateTime|null
     * @ORM\Column(type="datetime", name="publish_date", nullable=true)
     * @Assert\NotBlank()
     * @Assert\DateTime()
     */
    #[ORM\Column(name: 'publish_date', type: 'datetime', nullable: true)]
    protected ?\DateTimeInterface $publishDate;

    /**
     * @var \DateTime|null
     * @ORM\Column(type="datetime", name="unpublish_date", nullable=true)
     * @Assert\DateTime()
     * @Assert\Expression(
     *     expression="this.getUnpublishDate() == null or this.getUnpublishDate() > this.getPublishDate()",
     *     message="The unpublish date must be greater than the publish date"
     * )
     */
    #[ORM\Column(name: 'unpublish_date', type: 'datetime', nullable: true)]
    protected ?\DateTimeInterface $unpublishDate;

    public function __construct()
    {
        $this->publishDate = new \DateTime();
        $this->unpublishDate = new \DateTime();
    }

    public function getPublishDate(): ?\DateTimeInterface
    {
        return $this->publishDate;
    }

    public function setPublishDate(?\DateTimeInterface $publishDate = null): self
    {
        $this->publishDate = $publishDate;

        return $this;
    }

    public function getUnpublishDate(): ?\DateTimeInterface
    {
        return $this->unpublishDate;
    }

    public function setUnpublishDate(?\DateTimeInterface $unpublishDate = null): self
    {
        $this->unpublishDate = $unpublishDate;

        return $this;
    }

    /**
     * Defines if the content is published.
     *
     * @return bool
     */
    public function isPublished(): bool
    {
        $now = new \DateTime();

        return
            (null === $this->getUnpublishDate() && $this->getPublishDate() <= $now) ||
            ($now <= $this->getUnpublishDate() && $this->getPublishDate() <= $now);
    }
}
