<?php 
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

use Cake\Core\Configure;
use Cake\Http\Exception\NotFoundException;

class FilesController extends AppController
{

    public function initialize(): void
    {
        parent::initialize();
		$this->set('title', __('Files'));
		
	}


	// https://webscodex.com/how-to-upload-file-in-cakephp-4-part-5/ 
    public function upload()
    {
		
		$this->set('title', __('File upload for channels advertisment'));
		
		if ($this->request->is('post')) {
    	    $postData = $this->request->getData();
            $postImage = $this->request->getData('post_image');
            //$name = $postImage->getClientFilename();
			$name = 'advertising.jpg';
            $type = $postImage->getClientMediaType();
            $targetPath = WWW_ROOT. 'img'. DS . $name;
            if ($type == 'image/jpeg' || $type == 'image/jpg' || $type == 'image/png') {
				if(file_exists($targetPath)){
					unlink($targetPath);
				}
				if ($postImage->getSize() > 0 && $postImage->getError() == 0) {
					$postImage->moveTo($targetPath); 
					$this->Flash->success(__('Image upload successful. If the uploaded image does not appear, press Ctrl + F5 to refresh.'));
					return $this->redirect(['upload']);
				}
            }
		}

    }


}

