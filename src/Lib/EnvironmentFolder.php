<?php
namespace CakePostman\Lib;

use Cake\Core\Configure;
use Cake\Filesystem\Folder;
use CakePostman\Lib\EnvironmentFile;

class EnvironmentFolder extends Folder
{
    // global project name for regex and view usage
    public $projectName = null;

    /**
     * cunstruct to setup project name
     */
    public function __construct()
    {
        parent::__construct(Configure::read('CakePostman.environments.path'));
    }

    /**
     * gets all environment files for a specific regular expression
     * gets rid of system generated DS_Store file
     *
     * @return array of environment files
     */
        public function getEnvironments()
        {
            $environments = $this->find('^((?!\.DS_Store).)*$');

            foreach ($environments as $key => $fileName) {
                $environments[$key] = new EnvironmentFile($fileName);
            }
            return $environments;
        }

    /**
     * gets a specific environment file
     *
     * @param  string $fileName for specifig environment file
     * @return Environment file
     */
        public function getEnvironmentWithName($fileName)
        {
            // Use rawurlencode to ensure %20 is set to the correct filename
            $environmentFile = new EnvironmentFile(rawurlencode($fileName));
            return $environmentFile;
        }
}
