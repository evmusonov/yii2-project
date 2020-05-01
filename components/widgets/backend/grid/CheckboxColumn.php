<?php
namespace app\components\widgets\backend\grid;

use Closure;
use Yii;
use yii\helpers\Html;
use yii\helpers\Json;

class CheckboxColumn extends \yii\grid\CheckboxColumn
{
	protected function renderHeaderCellContent()
	{
		if ($this->header !== null || !$this->multiple) {
			return parent::renderHeaderCellContent();
		}

		return Html::checkbox($this->getHeaderCheckBoxName(), false, ['class' => 'select-on-check-all table-cbx']);
	}

	protected function renderDataCellContent($model, $key, $index)
	{
		if ($this->content !== null) {
			return parent::renderDataCellContent($model, $key, $index);
		}

		if ($this->checkboxOptions instanceof Closure) {
			$options = call_user_func($this->checkboxOptions, $model, $key, $index, $this);
		} else {
			$options = $this->checkboxOptions;
		}

		if (!isset($options['value'])) {
			$options['value'] = is_array($key) ? Json::encode($key) : $key;
		}

		if ($this->cssClass !== null) {
			Html::addCssClass($options, $this->cssClass);
		}

		$options['class'] = 'table-cbx';

		return Html::checkbox($this->name, !empty($options['checked']), $options);
	}
}