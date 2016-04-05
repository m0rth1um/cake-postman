<?php
namespace CakePostman\Lib;

use Cake\Core\Configure;
use Cake\Filesystem\File;
use Cake\I18n\Time;

class CollectionFile extends File
{
    // Collection file Version Number
    public $versionNumber = null;
    // Collection file Build Number
    public $buildNumber = null;
    // Created Date nicely formated to String
    public $created = null;

    // JSON decoded Collection name
    public $collectionName = null;
    // JSON decoded Collection description
    public $collectionDescription = null;
    // JSON decoded Array of Collection requests
    public $requests = null;

/**
 * __construct to set up all properties and call parent
 *
 * @param string $fileName to initialize Collection file
 */
    public function __construct($fileName)
    {
        parent::__construct(Configure::read('CakePostman.collections.path') . $fileName);

        $time = new Time($this->lastChange());
        $this->created = $time->nice();

        $removeProjectName = explode('-', $fileName);
        $removeFileSuffix = explode('.', $removeProjectName[1]);
        $seperateVersionBuild = explode('_', $removeFileSuffix[0]);
        $this->versionNumber = $seperateVersionBuild[0];
        $this->buildNumber = $seperateVersionBuild[1];
    }

/**
 * gets all Collection files
 *
 * @return array of Collection files
 */
    public function getCollections()
    {
        return $this->find();
    }

/**
 * gets all Collection file requests in sorted and ordered form
 * grouped by collection folder
 *
 * @return array with all collection file requests
 */
    public function getRequests()
    {
        $collectionData = json_decode($this->read(), true);

        $this->collectionName = $collectionData['name'];
        $this->collectionDescription = $collectionData['description'];

        $requestFolders = [];
        foreach ($collectionData['folders'] as $folder) {
            $requestFolders[$folder['id']] = [
                'name' => $folder['name'],
                'requests' => []
            ];
        }

        foreach ($collectionData['requests'] as $request) {
            if (empty($request['folder'])) {
                $requestFolders[0]['requests'][] = $request;
                continue;
            }
            $requestFolders[$request['folder']]['requests'][] = $request;
        }

        return $requestFolders;
    }
}
