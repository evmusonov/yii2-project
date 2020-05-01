<?php
namespace app\components\helpers;

use Yii;
use yii\web\UploadedFile;
use app\components\Thumbnailer;
use yii\helpers\FileHelper;

class Img
{
	public static function _($ModelName, $contentId, $version, $filename)
	{
		$thumbnailer = new Thumbnailer();
		
		$downloadPath = Yii::$app->params['images']['paths']['downloadDir'];
		$imagesPath = Yii::$app->params['images']['paths']['uploadDir'];
		$nophotoDir = Yii::$app->params['images']['paths']['nophotoDir'];
		$nophotoFilename = Yii::$app->params['images']['paths']['nophotoFilename'];
		$imagesVersion = Yii::$app->params['images']['versions'];
		
		if($filename AND !empty($filename) AND file_exists(Yii::getAlias($imagesPath.$ModelName.'/'.$contentId.'/'.$filename)))
		{
			if($version == 'original')
			{
				return $downloadPath.$ModelName.'/'.$contentId.'/'.$filename;
			}
			else
			{			
			if(!file_exists(Yii::getAlias($imagesPath.$ModelName.'/'.$contentId.'/'.$version.'/'.$filename)))
			{
				$filename_arr = explode('.', $filename);
				$ext = trim(strtolower(end($filename_arr)));
				
				$outputFormat = $ext;
				if($ext == 'jpg') $outputFormat = 'jpeg';
		
				FileHelper::createDirectory(Yii::getAlias($imagesPath.$ModelName.'/'.$contentId.'/'.$imagesVersion[$version]['uploadDir']));
				$thumbnailer->makeThumbnail(Yii::getAlias($imagesPath.$ModelName.'/'.$contentId.'/'.$filename), Yii::getAlias($imagesPath.$ModelName.'/'.$contentId.'/'.$imagesVersion[$version]['uploadDir'].$filename), $imagesVersion[$version]['typeMode'], $imagesVersion[$version]['width'], $imagesVersion[$version]['height'], $imagesVersion[$version]['locationMode'], $imagesVersion[$version]['quality'], '#FFF', $outputFormat);
			}
			return $downloadPath.$ModelName.'/'.$contentId.'/'.$version.'/'.$filename;
			}
		}
		else
		{
			return $downloadPath.$nophotoDir.$version.'/'.$nophotoFilename;
		}
	}
	
	public static function _galleryView($module = 'portfolio', $model = NULL, $form = NULL, $size = 'thumbgall', $link = 'files', $formName = 'imageGallery[]', $blockTitle = 'Фотогалерея')
	{
		return Yii::$app->view->renderFile('@app/modules/file/views/backend/gallery-block.php', 
											[
												'module' => $module, 
												'model' => $model,
												'form' => $form,
												'size' => $size,
												'link' => $link,
												'formName' => $formName,
												'blockTitle' => $blockTitle,
											]
										);
	}
}