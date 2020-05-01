<?php
namespace app\modules\article\components;

use Yii;
use app\modules\article\models\Article;

/**
 * Method for quick show of articles
 * @package app\modules\article\components
 */
class BlockArticle
{
	public static function front()
	{
		$articles = Article::find()->where(['status' => 1])->orderBy('weight')->all();

		return Yii::$app->view->renderFile('@app/modules/article/views/article-block-front.php', ['articles' => $articles]);
	}
}