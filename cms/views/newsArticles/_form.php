<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'news-articles-form',
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
<table>
	<tr><td>
	<div class="row">
		<?php echo $form->labelEx($model,'Title'); ?>
		<?php echo $form->textField($model,'Title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'Title'); ?>
	</div>
  
  
	 <div class="row">
		<?php echo $form->labelEx($model,'ActType'); ?>
		<?php echo $form->dropDownList($model,'ActType',array(
		'1'=>'所有类型',
		'2'=>'歌友会',
		'3'=>'抢话费',
		/* '4'=>'送豆豆', */
		'5'=>'其他',
		)); ?>
		<?php echo $form->error($model,'ActType'); ?>
	</div>
	<div class="row" id="articles_tree"></div>
	
    	<div class="row">
		<?php echo $form->labelEx($model,'CateId'); ?>
		<?php echo MHtml::activeCategories($model, 'CateId',$category,$Tree,array('type'=>2)); ?>
		<?php echo $form->error($model,'CateId'); ?>
	</div>
	
    <div class="row">
		<?php echo $form->labelEx($model,'City'); ?>
		<?php echo $form->dropDownList($model, 'City',Yii::app()->params['city']); ?>
		<?php echo $form->error($model,'City'); ?>
		
	</div>
	
	<div class="row">
	
		<?php echo $form->labelEx($model,'Tags'); ?>
		<?php echo $form->textArea($model,'Tags',array('rows'=>2, 'cols'=>50)); ?>
		<?php echo $form->error($model,'Tags'); ?>
   </div>
  
   <div class="row">
		<?php echo $form->labelEx($model,'Description'); ?>
		<?php echo $form->textArea($model,'Description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'Tags'); ?>
	</div>
	 </td>
	<td>
	<div class="row" id="NewsArticles_UId">
		<?php echo $form->labelEx($model,'Uid'); ?>
		<?php echo $form->textField($model,'Uid',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'Uid'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'Url'); ?>
		<?php echo $form->textArea($model,'Url',array('rows'=>2, 'cols'=>50)); ?>
		<?php echo $form->error($model,'Url'); ?>
    </div>
    <div class="row">
		<?php echo $form->labelEx($model,'WapUrl'); ?>
		<?php echo $form->textArea($model,'WapUrl',array('rows'=>2, 'cols'=>50)); ?>
		<?php echo $form->error($model,'WapUrl'); ?>
	</div>
	
    <div class="row">
		<?php echo $form->labelEx($model,'SmallImage'); ?>
		<?php echo CHtml::activeFileField($model, 'SmallImage',array(),$model->SmallImage); ?>
		<?php echo $form->error($model,'SmallImage'); ?>
	</div>
    <?php if (!empty($model->SmallImage)){?>
    <div class="row">
     <div style="padding: 1em 0 0 160px;">
				    <img width="80" height="50" src="<?php echo Yii::app()->request->BaseUrl.'/files/uploadfiles/'. $model->SmallImage ?>" /> &nbsp;
	</div>
    </div>
    <?php }?>
    <div class="row">
		<?php echo $form->labelEx($model,'BigImage'); ?>
		<?php echo CHtml::activeFileField($model, 'BigImage',array(),$model->BigImage); ?>
		<?php echo $form->error($model,'BigImage'); ?>
	</div>
    <?php if (!empty($model->BigImage)){?>
    <div class="row">
     <div style="padding: 1em 0 0 160px;">
				    <img width="80" height="50" src="<?php echo Yii::app()->request->BaseUrl.'/files/uploadfiles/'. $model->BigImage ?>" /> &nbsp;
	</div>
    </div>
    <?php }?>
    
	
	</td></tr></table>
	<div class="row">
		<?php echo $form->labelEx($model,'Content'); ?>
		<?php echo MHtml::activeTinyMceTextarea($model,'Content',array('rows'=>20, 'cols'=>90, 'fullPage'=>false)); ?>
	    <?php echo $form->error($model,'Content'); ?>
	</div>
	<script type="text/javascript">
	function toggleEditor(id) {
		if(!tinyMCE.get(id))
			tinyMCE.execCommand('mceAddControl', false, id);
		else
			tinyMCE.execCommand('mceRemoveControl', false, id);
	}
	jQuery(function($){
		if($("#NewsArticles_CateId").val()=='82'&& $("#add_tree").length<=0){
			$.ajax({
				   type: "POST",
				   url: "<?php echo $this->createUrl('getActicleTree');?>",
				   data: "AId=<?php echo $model->Id;?>",
				   success: function(msg){
					   if(msg==0){
						   $("#articles_tree").append('<div class="a_tree">outlet标题：<input size="20" maxlength="20" name="ArticlesTreeTitle[]" id="ArticlesTree_aTitle" type="text" value=""/>'+
								   '&nbsp;&nbsp;outlet地址：<input size="20" maxlength="50" name="ArticlesTreeUrl[]" id="ArticlesTree_aUrl" type="text" value=""/>'+
								   '<input type="button"  id="add_tree" value="增加"/><input type="button"  id="delete_tree" value="删除"/>'
								   );
							 
					   }else{
						 var msgReturn=eval('('+msg+')'); 
						 $.each(msgReturn,function(n,i){
							 var  mybutton='';
	                     if(n==0){
	                               mybutton='<input type="button"  id="add_tree" value="增加"/><input type="button"  id="delete_tree" value="删除"/>';		   
	                     }
							   $("#articles_tree").append('<div class="a_tree">outlet标题：<input size="20" maxlength="20" name="ArticlesTreeTitle[]" id="ArticlesTree_aTitle" type="text" value="'+i.Title+'"/>'+
							      '&nbsp;&nbsp;outlet地址：<input size="20" maxlength="50" name="ArticlesTreeUrl[]" id="ArticlesTree_aUrl" type="text" value="'+i.Url+'"/>'+mybutton+'</div>');
						        });
					   }
				   },
			       error: function(){
				       alert("请求失败，请稍后再试！");
			       }					
			});
			
		} 
		if($("#NewsArticles_CateId").val()=='86'){
			$("#NewsArticles_UId").show();
		}else{
			$("#NewsArticles_UId").hide();
		}
		$("#NewsArticles_CateId").change(function (){
			if($("#NewsArticles_CateId").val()=='82'&& $("#add_tree").length<=0){
				$.ajax({
					   type: "POST",
					   url: "<?php echo $this->createUrl('getActicleTree');?>",
					   data: "AId=<?php echo $model->Id;?>",
					   success: function(msg){
						   if(msg==0){
							   $("#articles_tree").append('<div class="a_tree">outlet标题：<input size="20" maxlength="20" name="ArticlesTreeTitle[]" id="ArticlesTree_aTitle" type="text" value=""/>'+
									   '&nbsp;&nbsp;outlet地址：<input size="20" maxlength="50" name="ArticlesTreeUrl[]" id="ArticlesTree_aUrl" type="text" value=""/>'+
									   '<input type="button"  id="add_tree" value="增加"/><input type="button"  id="delete_tree" value="删除"/>'
									   );
								 
						   }else{
							 var msgReturn=eval('('+msg+')'); 
							 $.each(msgReturn,function(n,i){
								 var  mybutton='';
		                     if(n==0){
		                               mybutton='<input type="button"  id="add_tree" value="增加"/><input type="button"  id="delete_tree" value="删除"/>';		   
		                     }
								   $("#articles_tree").append('<div class="a_tree">outlet标题：<input size="20" maxlength="20" name="ArticlesTreeTitle[]" id="ArticlesTree_aTitle" type="text" value="'+i.Title+'"/>'+
								      '&nbsp;&nbsp;outlet地址：<input size="20" maxlength="50" name="ArticlesTreeUrl[]" id="ArticlesTree_aUrl" type="text" value="'+i.Url+'"/>'+mybutton+'</div>');
							        });
						   }
					   },
				       error: function(){
					       alert("请求失败，请稍后再试！");
				       }					
				});
			}else{
				$("#articles_tree").empty();
			}
			if($("#NewsArticles_CateId").val()=='86'){
				$("#NewsArticles_UId").show();
			}else{
				$("#NewsArticles_UId").hide();
			}
			
          
		});
		$("#add_tree").live('click',function(){
			$("#articles_tree").append('<div class="a_tree">outlet标题：<input size="20" maxlength="50" name="ArticlesTreeTitle[]" id="ArticlesTree_aTitle" type="text" value=""/>&nbsp;&nbsp;outlet地址：<input size="20" maxlength="20" name="ArticlesTreeUrl[]" id="ArticlesTree_aUrl" type="text" value=""/></div>');	
		});
       $("#delete_tree").live('click',function(){
	       $(".a_tree:last-child").remove();
	   });
	});
	
	</script>
	<a href="javascript:toggleEditor('<?php echo MHtml::activeId($model, 'Content')?>');">Add/Remove editor</a>
	
	<div class="row">
	<strong style="color:red">推荐到：</strong>
	</div>
   <div class="recommend">
		<span><?php echo $form->checkBox($model,'IsWebImage'); ?>
        <?php echo $form->label($model,'IsWebImage'); ?>
		<?php echo $form->error($model,'IsWebImage'); ?>
		&nbsp;&nbsp;
		</span>
		<span>
		<?php echo CHtml::activeCheckBox($model,'IsWebList'); ?>
        <?php echo CHtml::activeLabel($model,'IsWebList'); ?>
		<?php echo $form->error($model,'IsWebList'); ?>
		&nbsp;&nbsp;
		</span>
		<span>
		<?php echo CHtml::activeCheckBox($model,'IsWapImage'); ?>
        <?php echo CHtml::activeLabel($model,'IsWapImage'); ?>
		<?php echo $form->error($model,'IsWapImage'); ?>
		&nbsp;&nbsp;
		</span>
		<span>
		<?php echo CHtml::activeCheckBox($model,'IsWapList'); ?>
        <?php echo CHtml::activeLabel($model,'IsWapList'); ?>
		<?php echo $form->error($model,'IsWapList'); ?>
		&nbsp;&nbsp;
		</span>
		<span>
		<?php echo CHtml::activeCheckBox($model,'IsWapIndex'); ?>
        <?php echo CHtml::activeLabel($model,'IsWapIndex'); ?>
		<?php echo $form->error($model,'IsWapIndex'); ?>
		&nbsp;&nbsp;
		</span>
		
	</div>
	<table>
	<tr><td>
	<div class="row">
	<?php
	    echo $form->labelEx($model,'ActiveStartDate');
		$this->widget('ext.my97.JMy97DatePicker',array(
	    'name'=>CHtml::activeName($model,'ActiveStartDate'),
	    'value'=>$model->ActiveStartDate,
	    'options'=>array('dateFmt'=>'yyyy-MM-dd HH:mm:ss'),
	    ));
	    echo $form->error($model,'ActiveStartDate');
	 ?>
	 </div>
	<div class="row">	
	<?php
	    echo $form->labelEx($model,'ActiveEndDate');
		$this->widget('ext.my97.JMy97DatePicker',array(
	    'name'=>CHtml::activeName($model,'ActiveEndDate'),
	    'value'=>$model->ActiveEndDate,
	    'options'=>array('dateFmt'=>'yyyy-MM-dd HH:mm:ss'),
	    ));
	    $form->error($model,'ActiveEndDate');
	 ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'NewHot'); ?>
		<?php echo $form->dropDownList($model,'NewHot',array(
		'1'=>'Default',
		'2'=>'New',
		'3'=>'Hot',
		'4'=>'New and Hot',
		)); ?>
		<?php echo $form->error($model,'NewHot'); ?>
	</div>
	</td><td>
   <div class="row">
		<?php echo $form->labelEx($model,'Status'); ?>
		<?php echo $form->dropDownList($model,'Status',array(
		'2'=>'发布',
		'1'=>'关闭',
		)); ?>
		<?php echo $form->error($model,'Status'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'JoinType'); ?>
		<?php echo $form->textField($model,'JoinType',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'JoinType'); ?>
	</div>
	
  <div class="row">
		<?php echo $form->labelEx($model,'Target'); ?>
		<?php echo $form->textField($model,'Target',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'Target'); ?>
	</div>
	<div class="row">	
	<?php
	    echo $form->labelEx($model,'CreatedDate');
		$this->widget('ext.my97.JMy97DatePicker',array(
	    'name'=>CHtml::activeName($model,'CreatedDate'),
	    'value'=>$model->CreatedDate,
	    'options'=>array('dateFmt'=>'yyyy-MM-dd HH:mm:ss'),
	    ));
	    $form->error($model,'CreatedDate');
	 ?>
	</div>
	</td>
   </table>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->