<?php

namespace Concrete\Package\MdVersionCompareHtmldiff\Controller\Panel\Detail\Page;

use Concrete\Core\Url\Resolver\Manager\ResolverManagerInterface;

class Versions extends \Concrete\Controller\Panel\Detail\Page\Versions
{
    public function view()
    {
        $cvIDs = (array) $this->request->query->get('cvID');
        $newVersionID = $cvIDs[0];
        $oldVersionID = end($cvIDs);
        if ($newVersionID === $oldVersionID) {
            $message = t('Version %s', $newVersionID);
        } else {
            $message = t('Comparing changes between version %s and %s', $newVersionID, $oldVersionID);
        }
        $this->set('message', [
            'title' => t('Preview Version'),
            'message' => $message
        ]);

        /** @var ResolverManagerInterface $resolver */
        $resolver = $this->app->make(ResolverManagerInterface::class);
        $url = $resolver->resolve(['/ccm/md/version_compare']);
        $url = $url->setQuery($this->request->query->all());

        $this->set('previewURL', $url);
    }
}
