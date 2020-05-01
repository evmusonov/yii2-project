<?php

namespace app\components\widgets;

use Yii;
use yii\bootstrap\Nav;
use yii\base\Widget;


class Debugger extends Widget
{

    public function init()
    {
        parent::init();
    }


    public function run()
    {
        echo $this->renderAdmin();
    }

    protected function renderAdmin()
    {
        $robots = $this->robotsName();
        $checkedIndex =  strpos($robots,'Вкл') !== false ? '' : 'checked';
        $buttonIndex = '<div class="nav-debug-button"><input type="checkbox" ' . $checkedIndex . ' class="cbx" id="cbx-index" style="display:none"/><label for="cbx-index" class="toggle debug-panel-index"><span></span></label></div>';
        $robots = '<div class="row"><div class="col-sm-4">' . $buttonIndex . '</div><div class="col-sm-8">Индексация сайта</div></div>';

        $debug = $this->debugName();
	    $checkedDebug =  strpos($debug,'Вкл') !== false ? '' : 'checked';
	    $buttonDebug = '<div class="nav-debug-button"><input type="checkbox" ' . $checkedDebug . ' class="cbx" id="cbx-debug" style="display:none"/><label for="cbx-debug" class="toggle debug-panel-debug"><span></span></label></div>';
		$debug = '<div class="row"><div class="col-sm-4">' . $buttonDebug . '</div><div class="col-sm-8">Debug-панель</div></div>';

        echo Nav::widget([
            'options' => ['class' => 'nav-debug navbar-nav navbar-left'],
            'encodeLabels' => false,
            'items' => [
                ['label' => $robots, /*'url' => ['/user/backend/default/debuger?action=robots'],*/'onclick' => 'return ', 'linkOptions' => [/*, 'data-method' => 'post'*/]],
                ['label' => $debug, /*'url' => ['/user/backend/default/debuger?action=debug'],*/ 'linkOptions' => [/*, 'data-method' => 'post'*/]],
            ],
        ]);
    }

    protected function robotsName()
    {
        $res='Выкл. индекс.';

        $filename='robots.txt';
        if(file_exists($filename))
        {
            $lines=file($filename);
            foreach ($lines as $key=>$line)
            {

                if(strpos($line,'#')===false)
                {
                    if( (strpos($line,'Disallow: *')!==false)||
                        (strpos($line,'Disallow: /')!==false)||
                        (strpos($line,'Disallow:/')!==false)||
                        (strpos($line,'Disallow:*')!==false)
                    )
                    {
                        $res='Вкл. индекс.';
                        break;
                    }

                }
            }

        }

        return $res;
    }

    protected function debugName()
    {
        $res='Вкл. debug';

        $filename='index.php';
        $content=file_get_contents($filename);
        $pos=strpos($content,'//defined(\'YII_DEBUG\') or define(\'YII_DEBUG\', true);');
        if($pos===false)
        {
            $res='Выкл. debug';
        }

        return $res;
    }

    public static function robotsCheck()
    {
        $filename = 'robots.txt';
        if(file_exists($filename)) {
            $lines = file($filename);
	        $fd = fopen($filename, 'w') or die("не удалось создать файл");
            $flag = false;
            foreach ($lines as $key => $line) {
                if (strpos($line, 'Disallow') !== false) {
                    $flag = true;
                    unset($lines[$key]);
                    break;
                }
            }
            if (!$flag) {
	            $lines[] = "Disallow: /";
            }
	        fwrite($fd, implode(PHP_EOL, $lines));
	        fclose($fd);

			return $flag;
        }

    }

    public static function debugCheck()
    {
        $str = 'defined(\'YII_DEBUG\') or define(\'YII_DEBUG\', true);';
        $str2 = 'defined(\'YII_ENV\') or define(\'YII_ENV\', \'dev\');';
        $filename = 'index.php';
        $content = file_get_contents($filename);
        $pos = strpos($content,'//'.$str);
        $flag = false; // on/off
        if($pos === false)
        {
            $content = str_replace($str,'//'.$str,$content);
            $content = str_replace($str2,'//'.$str2,$content);
        }
        else
        {
            $content = str_replace('//'.$str,$str,$content);
            $content = str_replace('//'.$str2,$str2,$content);
	        $flag = true;
        }

        file_put_contents($filename,$content);

        return $flag;
    }

}
