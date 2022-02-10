<?php

namespace Concrete\Package\MdVersionCompareHtmldiff\Controller\Panel\Detail\Page;

use Concrete\Core\Url\Resolver\Manager\ResolverManagerInterface;

class Versions extends \Concrete\Controller\Panel\Detail\Page\Versions
{
    public function view()
    {
        /** @var ResolverManagerInterface $resolver */
        $resolver = $this->app->make(ResolverManagerInterface::class);
        $url = $resolver->resolve(['/ccm/md/version_compare']);
        $url = $url->setQuery($this->request->query->all());

        $this->set('previewURL', $url);
    }
}
