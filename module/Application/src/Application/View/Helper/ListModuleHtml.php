<?php

namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\View\Model\ViewModel;
use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\ServiceManager;

class ListModuleHtml extends AbstractHelper implements ServiceManagerAwareInterface
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
     * @return array Array of modules
     */
    public function __invoke($options = null)
    {
        $date = new \DateTime($options['createdAt']);
        return '<div class="row-fluid module-row">
          <div class="span12">
              <div class="row-fluid">
                  <div class="module-info">
                      <div class="span5 module-author">
                          <div class="row-fluid">
                              <div class="span2">
                                  <img src="' . $options['picture'] . '" />
                              </div>
                              <div class="span10">
                                  <strong>' . $options['owner'] . '</strong>
                                  <p>
                                      <span class="author-label">Github:</span>
                                      <a href="' . $options['url'] . '">' . $options['moduleName'] . '</a><br />
                                      <!--
                                      <span class="author-label">Blog:</span> <a>placeholder</a><br />
                                      <span class="author-label">Modules:</span> <a>5</a><br /><br />
                                      <span class="author-label"><a>More info...</a>-->
                                  </p>
                              </div>
                          </div>
                      </div>
                      <div class="span5">
                          <strong>' . $options['moduleName'] . '</strong>
                          <p>
                              <!--<span class="author-label">Version:</span> 1.2.1<br />-->
                              <span class="author-label">Created:</span>' . 
                              ($date->format('Y-m-d')) . '
                              <br />
                              <!--<span class="author-label">Edited:</span> <a>15 days ago</a><br />
                              <span class="author-label">Tags:</span>
                              <span class="label">zf2</span>
                              <span class="label">Assetic</span>
                              <span class="label">Assets</span>
                              <span class="label">Sx</span>-->
                          </p>
                      </div>
                      <div class="span1">
                          <br />
                          <form action="<?php echo $this->url(\'' . $options['action'] . '\')?>" method="post">
                              <input type="hidden" name="repository" value="' . $options['returnUrl'] . '" />
                              <input type="submit" value="' . $options['submitValue'] . '" class="btn btn-danger"/>
                          </form>
                      </div>
                      <div style="clear: both;"></div>
                  </div>
              </div>
              <div class="row-fluid">
                  <div class="module-description">
                      <div class="span12">
                          <strong>Description</strong>
                          <p>' . $options['description'] . '</p>
                      </div>
                      <div style="clear: both;"></div>
                  </div>
              </div>
          </div>
      </div>';
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
