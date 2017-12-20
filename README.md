# Publication Bundle

A simple yet efficient publishing bundle.

## Install

Register the bundle to your 'app/AppKernel.php'

```php
    new Umanit\ContentPublicationBundle\UmanitContentPublicationBundle(),
```

## Usage

### Make your entity publishable

Implement the interface `PublishableInterface` and use the trait `PublishableTrait`.

```php
<?php

namespace AppBundle\Entity\Content;

use Doctrine\ORM\Mapping as ORM;
use Umanit\ContentPublicationBundle\Doctrine\Model\PublishableInterface;
use Umanit\ContentPublicationBundle\Doctrine\Model\PublishableTrait;

/**
 * @ORM\Table(name="news")
 * @ORM\Entity()
 */
class News implements PublishableInterface
{
    use PublishableTrait;
}
```

This will add two fields to your entity, `publishDate` and `unpublishDate`.
All your content will then be displayed only when the current datetime is between those fields.

### (Optional) Disable the filter for a specific firewall

Usually you'll need to administrate your contents.
For doing so, you can disable the filter by configuring the `disabled_firewalls` option.

```yaml
# app/config/config.yml
umanit_content_publication:
    disabled_firewalls: ['admin']
```

To follow this example, you'll need to add the `admin` firewall to your `security.yml file.
Check out the [Symfony documentation](https://symfony.com/doc/current/security/firewall_restriction.html) for more details.
