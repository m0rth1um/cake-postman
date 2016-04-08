<?php

namespace CakePostman\Controller;

use App\Controller\AppController as BaseController;


class AppController extends BaseController
{
    use \FrontendBridge\Lib\FrontendBridgeTrait;

    public $helpers = [
        'FrontendBridge' => ['className' => 'FrontendBridge.FrontendBridge']
    ];

    /**
     * [$components description]
     * @var [type]
     */
    public $components = [
        'FrontendBridge.FrontendBridge'
    ];

    public function beforeFilter(\Cake\Event\Event $event)
    {
        $this->FrontendBridge->setJson('locale', 'de');
    }

    public function render($view = null, $layout = null)
    {
        if ($this->_isJsonActionRequest()) {
            return $this->renderJsonAction($view, $layout);
        }
        return parent::render($view, $layout);
    }
}
