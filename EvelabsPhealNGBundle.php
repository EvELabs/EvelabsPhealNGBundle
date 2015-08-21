<?php

namespace Evelabs\PhealNGBundle;

use Evelabs\PhealNGBundle\DependencyInjection\EvelabsPhealNGExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class EvelabsPhealNGBundle extends Bundle
{
    public function getContainerExtension()
    {
        // return the right extension instead of "auto-registering" it.
        if (null === $this->extension) {
            return new EvelabsPhealNGExtension();
        }

        return $this->extension;
    }
}
