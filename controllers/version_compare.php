<?php

namespace Concrete\Package\MdVersionCompareHtmldiff\Controller;

use Concrete\Controller\Backend\UserInterface\Page as BackendInterfacePageController;
use Concrete\Core\Http\Response;
use Concrete\Core\Page\Page;
use Concrete\Core\View\View;
use Ssddanbrown\HtmlDiff\Diff;

class VersionCompare extends BackendInterfacePageController
{
    public function on_start()
    {
        parent::on_start();

        $this->view = new View($this->viewPath);
        $this->view->setPackageHandle('md_version_compare_htmldiff');
        $this->view->setController($this);

        $this->requireAsset('css', 'md_htmldiff');
    }

    public function view()
    {
        $cID = $this->request->query->get('cID');
        $cvIDs = (array) $this->request->query->get('cvID');
        $newVersionID = $cvIDs[0];
        $oldVersionID = end($cvIDs);

        $new = Page::getByID($cID, $newVersionID);
        $this->request->setCurrentPage($new);
        $this->request->setCustomRequestUser(-1);
        $controller = $new->getPageController();
        $controller->on_start();
        $controller->runAction('view');
        $controller->on_before_render();
        $view = $controller->getViewObject();
        $newContent = $view->render();

        $old = Page::getByID($cID, $oldVersionID);
        $response = new Response();
        if ($newVersionID === $oldVersionID) {
            $response->setContent($newContent);
        } else {
            $controller = $old->getPageController();
            $controller->on_start();
            $controller->runAction('view');
            $controller->on_before_render();
            $view = $controller->getViewObject();
            $oldContent = $view->render();
            $diff = new Diff($oldContent, $newContent);
            $response->setContent($diff->build());
        }
        $response->send();
        $this->app->shutdown();
    }

    protected function canAccess()
    {
        return $this->permissions->canViewPageVersions();
    }
}
