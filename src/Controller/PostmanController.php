<?php
namespace CakePostman\Controller;

use Cake\Event\Event;
use CakePostman\Controller\AppController;
use CakePostman\Lib\CollectionsFolder;
use CakePostman\Lib\EnvironmentFolder;

/**
 * Postman Controller
 *
 * @property \CakePostman\Model\Table\CollectionsTable $Collections
 */
class PostmanController extends AppController
{

/**
 * initialize parent and collection folder Object
 *
 * @return void
 */
    public function initialize()
    {
        parent::initialize();

        $this->CollectionFolder = new CollectionsFolder;
        $this->EnvironmentFolder = new EnvironmentFolder;
    }

/**
 * set up view and error message for wrongly named collection files
 *
 * @return void
 */
    public function index()
    {
        $invalidCollections = $this->CollectionFolder->getInvalidCollections();
        if (!empty($invalidCollections)) {
            $error = '<b>Collections entsprechen nicht dem Naming Standard:</b><br><br>';
            $error .= '<ul>';
            foreach ($invalidCollections as $file) {
                $error .= '<li><b>' . $file->name . '</li></b><br>' . '<i>(' . $file->path . ')</i>';
            }
            $error .= '</ul>';
            $error .= '<br><i>Beispiel: ' . $this->CollectionFolder->projectName . '-V1_B23.postman_collection</i>';
            $this->set(compact('invalidCollections', 'error'));
        }

        $projectName = $this->CollectionFolder->projectName;
        $collections = $this->CollectionFolder->getValidCollections();
        $this->set(compact('projectName', 'collections'));

        $environments = $this->EnvironmentFolder->getEnvironments();
        $this->set(compact('environments'));
    }

    /**
    * download collection file
    *
    * @param  string $fileName filename for clicked file
    * @return Response           response with downloadable file
    */
    public function downloadCollectionWithName($fileName = null)
    {
        $file = $this->CollectionFolder->getCollectionWithName($fileName);
        $this->response->file($file->path);

        return $this->response;
    }

    /**
     * download environment file
     *
     * @param  string $fileName filename for clicked file
     * @return Response           response with downloadable file
     */
        public function downloadEnvironmentWithName($fileName = null)
        {
            $file = $this->EnvironmentFolder->getEnvironmentWithName($fileName);
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
        $file = $this->CollectionFolder->getCollectionWithName($fileName);
        $collectionData = $file->getRequests();

        $this->set(compact('collectionData', 'file'));
    }

}
