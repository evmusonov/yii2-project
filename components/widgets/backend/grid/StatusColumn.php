<?php
/**
 * Created by PhpStorm.
 * User: СТД
 * Date: 10.08.2016
 * Time: 23:08
 */

namespace app\components\widgets\backend\grid;

use yii\grid\DataColumn;
use yii\helpers\Html;
use Yii;


class StatusColumn extends DataColumn
{
    public $fieldType = 'hidden';
    public $filter = [0 => 'Отключен', 1 => 'Активен'];

    protected function renderDataCellContent($model, $key, $index)
    {
        $value = $this->getDataCellValue($model, $key, $index);
        $class = $value ? 'success on' : 'default off';
        $title = $value ? 'Отключить' : 'Активировать';
        $checked = $value ? 'checked="checked"' : '';

	    $span = '<div class="custom-toggle-button"><input type="checkbox" ' . $checked . ' class="cbx grid-input" id="cbx' . $index . '" style="display:none"/><label for="cbx' . $index . '" class="toggle"><span></span></label></div>';
        $field = Html::activeInput($this->fieldType, $model, $this->attribute, ['name' => 'multiedit['.$key.']['.$this->attribute.']', 'class' => 'hidden-status']);

        $html = $span.$field;

        return $value === null ? $this->grid->emptyCell : $html;
    }
}