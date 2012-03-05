<?php

/**
 * JMy97DatePicker class file.
 *
 * @author jerry2801 <jerry2801@gmail.com>
 * @version alpha 3 (2010-6-7 14:47)
 *
 * A typical usage of JMy97DatePicker is as follows:
 * <pre>
 * $this->widget('ext.my97DatePicker.JMy97DatePicker',array(
 *     'name'=>CHtml::activeName($model,'sendStartDateToForm'),
 *     'value'=>$model->sendStartDateToForm,
 *     'options'=>array('dateFmt'=>'yyyy-MM-dd'),
 * ));
 * </pre>
 */

Yii::import('zii.widgets.jui.CJuiInputWidget');

class JMy97DatePicker extends CJuiInputWidget
{
    public function init()
    {
        $path=dirname(__FILE__).DIRECTORY_SEPARATOR.'source';
        $baseUrl=Yii::app()->getAssetManager()->publish($path);
        $cs=Yii::app()->getClientScript();
        $cs->registerScriptFile($baseUrl.'/WdatePicker.js');

        $options=CJavaScript::jsonEncode($this->options);
        $this->htmlOptions['onclick']=strtr('WdatePicker({options});',array('{options}'=>$options));
		if($this->hasModel())
			echo CHtml::activeTextField($this->model,$this->attribute,$this->htmlOptions);
		else
        {
            list($name,$id)=$this->resolveNameID();
			echo CHtml::textField($name,$this->value,$this->htmlOptions);
        }
    }
}