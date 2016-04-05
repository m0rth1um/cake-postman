<?php
namespace CakePostman\Lib;

use Cake\Core\Configure;
use Cake\Filesystem\File;
use Cake\I18n\Time;

class EnvironmentFile extends File
{
    // Environment name
    public $environmentName = null;
    // Environment url
    public $url = null;
    // Created Date nicely formated to String
    public $created = null;

    /**
    * __construct to set up all properties and call parent
    *
    * @param string $fileName to initialize Environment file
    */
    public function __construct($fileName)
    {
        parent::__construct(Configure::read('CakePostman.environments.path') . $fileName);

        $environmentData = json_decode($this->read(), true);

        $this->environmentName = $environmentData['name'];
        $this->url = $environmentData['values'][0]['value'];

        $time = new Time($this->lastChange());
        $this->created = $time->nice();
    }

    /**
     * gets all Environment files
     *
     * @return array of Environment files
     */
    public function getEnvironments()
    {
        return $this->find();
    }
}
