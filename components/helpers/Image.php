<?php
namespace app\components\helpers;

use Yii;
use yii\web\UploadedFile;
use app\components\Thumbnailer;
use yii\helpers\FileHelper;
use app\modules\file\models\File;
use yii\base\ErrorException;

class Image
{
	public static function getMaxDelta($contentId, $model,$type)
	{
		$n= File::find()->where(['content_id'=>$contentId,'module'=>$model,'type'=>$type])->max('delta');
		if(!$n)
			$n=0;
		return $n;
	}


    public static function checkName($ModelName, $contentId, $model, $filename, $ext = 'jpg')
    {
        $imagesPath = Yii::$app->params['images']['paths']['uploadDir'];
        $r_filename=$filename;
        $fileName=Yii::getAlias($imagesPath . $ModelName . '/' . $contentId . '/' . $filename . '.' . $ext);
        $n=1;
        while (file_exists($fileName))
            {
                $r_filename=$filename .'_'.$n++;

                $fileName=Yii::getAlias($imagesPath . $ModelName . '/' . $contentId . '/' . $r_filename . '.' . $ext);
            }

        return $r_filename;
    }
	
	public static function load($ModelName, $contentId, $model, $filename, $ext = 'jpg')
	{
		$thumbnailer = new Thumbnailer();
		
		$ext = strtolower($ext);
		$outputFormat = $ext;
		
		if($ext == 'jpg') $outputFormat = 'jpeg';
		
		$imagesPath = Yii::$app->params['images']['paths']['uploadDir'];
		$imagesVersion = Yii::$app->params['images']['versions'];
					
		FileHelper::createDirectory(Yii::getAlias($imagesPath.$ModelName.'/'.$contentId.'/'));
		$model->saveAs(Yii::getAlias($imagesPath.$ModelName.'/'.$contentId.'/'.$filename.'.'.$ext));
		
		foreach($imagesVersion as $version => $value)
		{
			if($value['isDefault'])
			{
				FileHelper::createDirectory(Yii::getAlias($imagesPath.$ModelName.'/'.$contentId.'/'.$value['uploadDir']));
				$thumbnailer->makeThumbnail(Yii::getAlias($imagesPath.$ModelName.'/'.$contentId.'/'.$filename.'.'.$ext), Yii::getAlias($imagesPath.$ModelName.'/'.$contentId.'/'.$value['uploadDir'].$filename.'.'.$ext), $value['typeMode'], $value['width'], $value['height'], $value['locationMode'], $value['quality'], '#FFF', $outputFormat);
			}
		}
	}

    public static function copy_files($ModelName, $contentId, $filename,$new_contentId)
    {
        try
        {
            $imagesPath = Yii::$app->params['images']['paths']['uploadDir'];
            FileHelper::createDirectory(Yii::getAlias($imagesPath.$ModelName.'/'.$new_contentId.'/'));
            copy(Yii::getAlias($imagesPath.$ModelName.'/'.$contentId.'/'.$filename),Yii::getAlias($imagesPath.$ModelName.'/'.$new_contentId.'/'.$filename));
        }
        catch(ErrorException $e)
        {
            //подумаешь файла нету - ибо нефиг г копировать
        }


    }
	
	public static function deleteAsPost($postRequest = false)
	{
		$return = false;
		
		if ($postRequest)
		{
			$imagesPath = Yii::$app->params['images']['paths']['uploadDir'];
			$imagesVersion = Yii::$app->params['images']['versions'];
			
			$success = is_file(Yii::getAlias($imagesPath.$postRequest['module'].'/'.$postRequest['contentId'].'/'.$postRequest['fileName'])) && unlink(Yii::getAlias($imagesPath.$postRequest['module'].'/'.$postRequest['contentId'].'/'.$postRequest['fileName']));
			if ($success) {
				foreach ($imagesVersion as $version => $value) {
					
					if (is_file(Yii::getAlias($imagesPath.$postRequest['module'].'/'.$postRequest['contentId'].'/'.$value['uploadDir'].$postRequest['fileName']))) {
						unlink(Yii::getAlias($imagesPath.$postRequest['module'].'/'.$postRequest['contentId'].'/'.$value['uploadDir'].$postRequest['fileName']));
					}
				}
			}
			File::findOne($postRequest['fileId'])->delete();
			$return = true;
        } 
		return $return;
	}
	
	public static function delete($module = '', $contentId = 0, $fileName = '', $fileId = 0)
	{
		$return = false;
		
		$imagesPath = Yii::$app->params['images']['paths']['uploadDir'];
		$imagesVersion = Yii::$app->params['images']['versions'];
		
		$success = is_file(Yii::getAlias($imagesPath.$module.'/'.$contentId.'/'.$fileName)) && unlink(Yii::getAlias($imagesPath.$module.'/'.$contentId.'/'.$fileName));
		if ($success) {
			foreach ($imagesVersion as $version => $value) {
				
				if (is_file(Yii::getAlias($imagesPath.$module.'/'.$contentId.'/'.$value['uploadDir'].$fileName))) {
					unlink(Yii::getAlias($imagesPath.$module.'/'.$contentId.'/'.$value['uploadDir'].$fileName));
				}
			}
		}
		File::findOne($fileId)->delete();
		$return = true;
		return $return;
	}
}