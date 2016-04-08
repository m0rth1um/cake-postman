<?php
namespace CakePostman\Lib;

use Cake\Core\Configure;
use Cake\Filesystem\Folder;
use CakePostman\Lib\CollectionFile;

class CollectionsFolder extends Folder
{
    // global project name for regex and view usage
    public $projectName = null;

/**
 * cunstruct to setup project name
 */
    public function __construct()
    {
        parent::__construct(Configure::read('CakePostman.collections.path'));

        $this->projectName = rawurlencode(Configure::read('CakePostman.collections.fileNameIdentifer'));
    }

/**
 * gets all collection with valid naming scheme and orders them in the correct version index
 *
 * @return array version and build orderen collection files
 */
    public function getValidCollections()
    {
        $regExString = '(' . $this->projectName . '-V\d+_B\d+(\.json)?\.postman_collection)';

        $collections = $this->getCollectionsWithRegexString($regExString);

        $sortedCollections = [];
        foreach ($collections as $file) {
            $sortedCollections[$file->versionNumber] = [
                'version' => $file->versionNumber,
                'collections' => []
            ];
        }

        foreach ($sortedCollections as $versionIdentifier => $key) {
            foreach ($collections as $file) {
                if ($file->versionNumber === $versionIdentifier) {
                    $sortedCollections[$versionIdentifier]['collections'][] = $file;
                    continue;
                }
            }
        }

        return $sortedCollections;
    }

/**
 * gets all invalid collections to display them in error flash
 *
 * @return array ordered array of invalid collection files
 */
    public function getInvalidCollections()
    {
        $regExString = '^((?!' . $this->projectName . '-V\d+_B\d+(\.json)?.postman_collection).)*$';
        return $this->getCollectionsWithRegexString($regExString);
    }

/**
 * gets all collection files for a specific regular expression
 * gets rid of system generated DS_Store file
 *
 * @param  String $regExString reg ex string to filter files from folder
 * @return array of collection files
 */
    protected function getCollectionsWithRegexString($regExString)
    {
        $files = $this->find($regExString, true);

        foreach ($files as $key => $fileName) {

            if ($fileName === '.DS_Store') {
                unset($files[$key]);
                continue;
            }
            $files[$key] = new CollectionFile($fileName);

        }
        return $files;
    }

/**
 * gets a specific collection file
 *
 * @param  string $fileName for specifig collection file
 * @return Collection file
 */
    public function getCollectionWithName($fileName)
    {
        $collectionFile = new CollectionFile($fileName);
        return $collectionFile;
    }
}
