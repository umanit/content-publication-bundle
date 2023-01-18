<?php

namespace Umanit\ContentPublicationBundle\Doctrine\Model;

interface PublishableInterface
{
    public function getPublishDate(): ?\DateTimeInterface;

    public function setPublishDate(?\DateTimeInterface $publishDate = null): self;

    public function getUnpublishDate(): ?\DateTimeInterface;

    public function setUnpublishDate(?\DateTimeInterface $unpublishDate = null): self;
}
