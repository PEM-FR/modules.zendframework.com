<?php

namespace User\View\Helper;

use Application\View\Helper\ListModules;
use Zend\View\Model\ViewModel;
use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\ServiceManager;

class UserRepositories extends ListModules implements ServiceManagerAwareInterface
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
        //need to fetch top lvl ServiceManager
        $sm = $this->getServiceManager()->getServiceLocator();

        $api = $sm->get('edpgithub_api_factory');

        $service = $api->getService('Repo');
        $mapper = $sm->get('application_module_mapper');

        $sort = isset($options['sort'])? $options['sort']:false;

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

        if ($sort) {
            $repositories = $this->sortModules($repositories, $sm);
        }

        return $repositories;
    }    

    protected function sortModules($unsorted, $sm)
    {
        $modules = array(
            'owned' => array(),
            'collaborations' => array(),
//            'forks' => array(),
//            'submitted' => array(),
        );

        foreach ($unsorted as $module) {
            $owner = $module->getOwner();
            $user = $sm->get('zfcuser_user_service')->getAuthService()->getIdentity();
            if ($owner['login'] == $user->getUsername()) {
                $modules['owned'][] = $module;
            } else {
                $modules['collaborations'][] = $module;
            }
        }

        return $modules;
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
