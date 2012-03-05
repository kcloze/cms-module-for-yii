<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'news-videos-form',
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array('enctype'=>'multipart/form-data')
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	

	<div class="row">
		<?php echo $form->labelEx($model,'CateId'); ?>
		<?php echo MHtml::activeCategories($model, 'CateId',$category,$Tree,array('type'=>2)); ?>
		<?php echo $form->error($model,'CateId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Title'); ?>
		<?php echo $form->textField($model,'Title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'Title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Description'); ?>
		<?php echo $form->textArea($model,'Description',array('rows'=>2, 'cols'=>50)); ?>
		<?php echo $form->error($model,'Description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'VideoThumb'); ?>
       <?php echo CHtml::activeFileField($model, 'VideoThumb',array(),$model->VideoThumb); ?>		
       <?php echo $form->error($model,'VideoThumb'); ?>
	</div>
    <?php if (!empty($model->VideoThumb)){?>
    <div class="row">
     <div style="padding: 1em 0 0 160px;">
				    <img width="150" height="100" src="<?php echo Yii::app()->request->BaseUrl.'/files/uploadfiles/'.$model->VideoThumb ?>" /> &nbsp;
	</div>
    </div>
    <?php }?>
	<div class="row">
	<input id="NewsVideos_Video" type="hidden" name="NewsVideos[Video]" value="0">
	<input id="NewsVideos_id" type="hidden" name="" value="<?php echo $model->Id;?>">
	</div>
	<div id="videoList" class="row">
	
	<?php if (!empty($model->Video)){?>
	<div  id="pimg_<?php echo $model->Id; ?>" style="float:left; width:140px; text-algin:center;">
	<img src="<?php echo Yii::app()->request->BaseUrl;?>/images/folder_page.png"/></br>
	<a href="<?php echo Yii::app()->request->BaseUrl.'/files/uploadfiles/'.$model->Video?>">下载</a>
	<a onclick=deleteByVid("<?php echo $model->Id;?>") id="delete_vid" href="javascript:;">删除</a>&nbsp;&nbsp;&nbsp;
	<input type="hidden" value="<?php echo $model->Video;?>" name="NewsVideos[Video]"/>
	</div>
	<?php }?>
	</div>
 <div class="row buttons" style="clear:both; padding-top:10px;">
 <label for="NewsVideos_VideoThumb">上传视频</label>
 <?php $this->widget('MUploadify',array(
  'name'=>'myPicture',
  'script'=>$this->createUrl('upload'),
 //'script'=>'upload',
 'auto'=>false,
 'multi'=>false,
 'fileDesc'=>'支持格式:/swf/flv',
 'fileExt'=>'*.flv;*.swf',
 'onSelectOnce'=>'js:function(){
 var id=$("#NewsVideos_id").val();
 
 $("#myPicture").uploadifySettings("scriptData",{\'Id\':id});
 }', 
 'onComplete'=>'js:function (event,queueId,fileObj,response,data) {
 response=eval(\'(\'+response+\')\');
 if(response.video!=\'\'){ 
  $("#videoList").html("<div id=\"pimg_"+response.vid+"\" style=\"float:left; width:140px; text-algin:center;\"><img  src=\''.Yii::app()->request->BaseUrl.'/images/folder_page.png\'></br><a href=\''.Yii::app()->request->BaseUrl.'/files/uploadfiles/"+response.video+"\'>下载</a>&nbsp;&nbsp;&nbsp;<a onclick=deleteByPid("+response.vid+") id=\"delete_vid\" href=\"javascript:;\">删除</a>&nbsp;&nbsp;&nbsp;<input type=\"hidden\" value=\""+response.video+"\" name=\"NewsVideos[Video]\"/></div>");
 
 }
 }',
 //'onError' => 'js:function(evt,queueId,fileObj,errorObj){alert("Error: " + errorObj.type + "\nInfo: " + errorObj.info);}',
 
  //'someOption'=>'someValue',
));
?>
 </div>
	<script language="JavaScript" type="text/javascript">
 function deleteByVid(id){
	 //var pid=$(this).attr("name");
	  $.ajax({
		   type: "POST",
		   url: "<?php echo $this->createUrl('deleteAjax');?>",
		   data: "vid="+id,
		   success: function(msg){
			   $("#pimg_"+id).remove();
		   },
		   error:function(){
		   },
		});
 }
 
 
 </script>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->