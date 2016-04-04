<?php
namespace CakePostman\Controller;

use Cake\Event\Event;
use CakePostman\Controller\AppController;
use CakePostman\Lib\CollectionsFolder;

/**
 * Collections Controller
 *
 * @property \CakePostman\Model\Table\CollectionsTable $Collections
 */
class CollectionsController extends AppController
{

/**
 * initialize parent and collection folder Object
 *
 * @return void
 */
    public function initialize()
    {
        $this->collectionFolder = new CollectionsFolder;
        parent::initialize();
    }

/**
 * set up view and error message for wrongly named collection files
 *
 * @return void
 */
    public function index()
    {
        $invalidCollections = $this->collectionFolder->getInvalidCollections();
        if (!empty($invalidCollections)) {
            $error = '<h3>Collections entsprechen nicht dem Naming Standard</h3><br>';
            $error .= '<ul>';
            foreach ($invalidCollections as $file) {
                $error .= '<li>' . $file->path . '</li><br>';
            }
            $error .= '</ul>';
            $error .= '<br><i>Beispiel: ' . $this->collectionFolder->projectName . '-V1_B23.postman_collection</i>';
            $this->set(compact('invalidCollections', 'error'));
        }

        $projectName = $this->collectionFolder->projectName;
        $collections = $this->collectionFolder->getValidCollections();
        $this->set(compact('projectName', 'collections'));
    }

/**
 * download collection file
 *
 * @param  string $fileName filename for clicked file
 * @return Response           response with downloadable file
 */
    public function downloadFileWithName($fileName = null)
    {
        $file = $this->collectionFolder->getCollectionWithName($fileName);
        $this->response->file($file->path);

        return $this->response;
    }

/**
 * view detail of collection view file
 *
 * @param  string $fileName filename for viewable collection file
 * @return void
 */
    public function view($fileName = null)
    {
        $file = $this->collectionFolder->getCollectionWithName($fileName);
        $collectionData = $file->getRequests();

        $this->set(compact('collectionData', 'file'));
    }

}
