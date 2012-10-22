<?php

namespace User\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\View\Model\ViewModel;
use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\ServiceManager;

class UserRepositories extends AbstractHelper implements ServiceManagerAwareInterface
{
    /**
     * $var string template used for view
     */
    protected $viewTemplate;

        /**
     * @var ServiceManager
     */
    protected $serviceManager;

    /**
     * __invoke
     *
     * @access public
     * @param array $options array of options
     * @return string
     */
    public function __invoke($options = array())
    {
        $sm = $this->getServiceManager();

        //need to fetch top lvl ServiceManager
        $sm = $sm->getServiceLocator();
        $api = $sm->get('edpgithub_api_factory');

        $service = $api->getService('Repo');
        $mapper = $sm->get('application_module_mapper');

        $repositories = $service->listRepositories(null, 'all');

        foreach($repositories as $key => $repo) {
            if(!$repo->getFork()) {
                $module = $mapper->findByName($repo->getName());
                if($module) {
                    unset($repositories[$key]);
                }
            } else {
                unset($repositories[$key]);
            }
        }

        return $repositories;
    }    

    /**
     * Retrieve service manager instance
     *
     * @return ServiceManager
     */
    public function getServiceManager()
    {
        return $this->serviceManager;
    }

    /**
     * Set service manager instance
     *
     * @param ServiceManager $locator
     * @return User
     */
    public function setServiceManager(ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;
        return $this;
    }
}
