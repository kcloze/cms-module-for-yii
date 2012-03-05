<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'news-images-cate-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php
	 
	echo $form->errorSummary($model); ?>

    <div class="row">
		<?php echo $form->labelEx($model,'Title'); ?>
		<?php echo $form->textField($model,'Title'); ?>
		<?php echo $form->error($model,'Title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CateId'); ?>
		<?php echo MHtml::activeCategories($model, 'CateId',$category,$Tree,array('type'=>2)); ?>
		<?php echo $form->error($model,'CateId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ImageThumbScale'); 
		isset($model->ImageThumbScale)&& $ImageThumbScale=explode('*',$model->ImageThumbScale);
		?>
		<?php echo $form->textField($model,'ImageThumbScale',array('name'=>'ImageThumbScaleW','id'=>'ImageThumbScaleW','size'=>5,'maxlength'=>10,'value'=>$ImageThumbScale[0])); ?>
		*
		<?php echo $form->textField($model,'ImageThumbScale',array('name'=>'ImageThumbScaleH','id'=>'ImageThumbScaleH','size'=>5,'maxlength'=>10,'value'=>$ImageThumbScale[1])); ?>
		
		<?php echo $form->error($model,'ImageThumbScale'); ?>
	</div>
	
   <div class="row" id="imageList">
   <?php if(isset($Pictures)&&is_array($Pictures)){
   	foreach($Pictures as $k=>$val){
   		$checked=$val['Id']==$model->CoverImage?'checked=checked':'';
   		?>
       
      <div id="pimg_<?php echo $val['Id'];?>" style="float:left; width:140px; text-algin:center;">
      <img width="100" height="100" src="<?php echo Yii::app()->request->BaseUrl."/files/uploadfiles/".$val['Image'];?>"><br>
      <a href="javascript:;" onclick="deleteByPid(<?php echo $val['Id'];?>);" id="delete_pid" name="<?php echo $val['Id'];?>">删除</a>&nbsp;&nbsp;&nbsp;
      <input type="radio" value="<?php echo $val['Id'];?>" <?php echo ' '.$checked;?>name="NewsImagesCate[CoverImage]"> 设为封面<input type="hidden" name="NewsImagesCate[pid]" value="<?php echo $val['Id'];?>">
      </div>
     
   <?php 	}
     }?>
  
   </div>
    <div class="row" id="mid">
    <input name="NewsImagesCate[mid]" id="NewsImagesCate_mid" type="hidden" value="<?php echo $model->Id;?>">
    </div>
   
	<div class="row buttons" style="clear:both; padding-top:10px;">
 <?php $this->widget('MUploadify',array(
  'name'=>'myPicture',
  'script'=>$this->createUrl('upload'),
 //'script'=>'upload',
 'auto'=>false,
 'multi'=>true,
 'fileDesc'=>'支持格式:jpg/gif/jpeg/png/bmp/swf/pdf/rar.',
 'fileExt'=>'*.jpg;*.gif;*.png;*.rar;*.pdf;*.jpeg;*.bmp',
 'onSelectOnce'=>'js:function(){
 var imgw=$("#ImageThumbScaleW").val();
 var imgh=$("#ImageThumbScaleH").val();
 var cateId=$("#NewsImagesCate_CateId").val();
 var mid=$("#NewsImagesCate_mid").val();
 
 if($("#ImageThumbScaleW").val()==\'\'){
     alert("请填写压缩比例");
     $("#myPicture").uploadifyClearQueue();
     return false;
 }
 if($("#ImageThumbScaleH").val()==\'\'){
     alert("请填写压缩比例");
     $("#myPicture").uploadifyClearQueue();
     return false;
 }
 if($("#NewsImagesCate_CateId").val()==\'\'){
     alert("请选择分类");
     $("#myPicture").uploadifyClearQueue();
     return false;
 }
 $("#myPicture").uploadifySettings("scriptData",{\'imgw\':imgw,\'imgh\':imgh,\'cateId\':cateId,\'mId\':mid});
 }', 
 'onComplete'=>'js:function (event,queueId,fileObj,response,data) {
 response=eval(\'(\'+response+\')\');
 if(response.mid!=\'\'){
 $("#mid").html("<input name=\"NewsImagesCate[mid]\" id=\"NewsImagesCate_mid\" type=\"hidden\" value=\""+response.mid+"\">");
 
 }
 $("#imageList").append("<div id=\"pimg_"+response.pid+"\" style=\"float:left; width:140px; text-algin:center;\"><img width=\"100\" height=\"100\" src=\''.Yii::app()->request->BaseUrl.'/files/uploadfiles/"+response.img+"\'></br><a onclick=deleteByPid(\""+response.pid+"\") id=\"delete_pid\" href=\"javascript:;\">删除</a>&nbsp;&nbsp;&nbsp;<input name=\'NewsImagesCate[CoverImage]\' type=\"radio\" value=\""+response.pid+"\"> 设为封面</input><input type=\"hidden\" value=\""+response.pid+"\" name=\"NewsImagesCate[pid]\"/></div>");
 }',
 //'onError' => 'js:function(evt,queueId,fileObj,errorObj){alert("Error: " + errorObj.type + "\nInfo: " + errorObj.info);}',
 
  //'someOption'=>'someValue',
));
?>
 </div>
 <script language="JavaScript" type="text/javascript">
 function deleteByPid(pid){
	 //var pid=$(this).attr("name");
	  $.ajax({
		   type: "POST",
		   url: "<?php echo $this->createUrl('deleteAjax');?>",
		   data: "pid="+pid,
		   success: function(msg){
			   $("#pimg_"+pid).remove();
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