<?php
/**
 * AjaxUploadTinyMCE5.php file.
 *
 * @category YupeComponents
 * @package  yupe.modules.yupe.components.actions
 * @author   Anton Kucherov <idexter.ru@gmail.com>
 * @license  BSD https://raw.github.com/yupe/yupe/master/LICENSE
 * @version  0.1
 * @link     https://yupe.ru
 */

namespace yupe\components\actions;

use Yii;
use CAction;
use yupe\helpers\YText;
use yupe\models\UploadForm;
use CUploadedFile;

/**
 * Class AjaxUploadTinyMCE5
 * @package yupe\components\actions
 */
class YAjaxUploadTinyMCE5Action extends CAction
{
	public $rename = true;

    /**
     * @throws \CHttpException
     */
    public function run()
    {
	    $accepted_origins = array("http://localhost", "http://192.168.1.1", "http://yupe19052020");

		  /*********************************************
		   * Change this line to set the upload folder *
		   *********************************************/
		  $imageFolder = "uploads/";

		  reset($_FILES);
		  $temp = current($_FILES);
		  if (is_uploaded_file($temp['tmp_name'])){
		    /*if (isset($_SERVER['HTTP_ORIGIN'])) {
		      // same-origin requests won't set an origin. If the origin is set, it must be valid.
		      if (in_array($_SERVER['HTTP_ORIGIN'], $accepted_origins)) {
		        header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
		      } else {
		        header("HTTP/1.1 403 Origin Denied");
		        return;
		      }
		    }*/
	        // header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);

		    /*
		      If your script needs to receive cookies, set images_upload_credentials : true in
		      the configuration and enable the following two headers.
		    */
		    // header('Access-Control-Allow-Credentials: true');
		    // header('P3P: CP="There is no P3P policy."');

		    // Sanitize input
		    /*if (preg_match("/([^\w\s\d\-_~,;:\[\]\(\).])|([\.]{2,})/", $temp['name'])) {
		        header("HTTP/1.1 400 Invalid file name.");
		        return;
		    }*/

		    // Verify extension
		    if (!in_array(strtolower(pathinfo($temp['name'], PATHINFO_EXTENSION)), array("gif", "jpg", "png"))) {
		        header("HTTP/1.1 400 Invalid extension.");
		        return;
		    }

		    // Accept upload if there was no origin, or if it is an accepted origin
		    $name = $temp['name'];
		    $extension = pathinfo($temp['name'], PATHINFO_EXTENSION);

		    $fileName = $this->rename ?
	            md5(time().uniqid().$name).'.'.$extension :
	            YText::translit(
	                str_ireplace($extension, '', $name)
	            ).'_'.time().'.'.$extension;

		    $filetowrite = $imageFolder . 'image/' . $fileName;
		    move_uploaded_file($temp['tmp_name'], $filetowrite);

		    // Respond to the successful upload with JSON.
		    // Use a location key to specify the path to the saved image resource.
		    // { location : '/your/uploaded/image/file'}
		    echo json_encode(array('location' => "/".$filetowrite));
		  } else {
		    // Notify editor that the upload failed
		    header("HTTP/1.1 500 Server Error");
		  }
    }

}
