<div class="list-tem">
<div class="row">
    <div class="col-sm-12">
     <div>        

        <?php echo CHtml::encode($data->username); ?> | 
        <?php echo CHtml::encode(Yii::app()->dateFormatter->format("dd MMMM yyyy", $data->date_created)); ?> | 
        <?php echo CHtml::link(
        	CHtml::encode( $data->useremail),
        	"mailto:".CHtml::encode( $data->useremail)
        );
        ?>
       </div>
       <div>
       <span class="review-status">
       <?php echo $this->module->getModerationStatus($data->moderation); ?>
       </span>
       <?php echo CHtml::radioButtonList("moderation_".$data->id, $data->moderation, array("1"=>"Опубликовать","0"=>"Не показывать", "2"=>"На модерации"), array("separator"=>"&nbsp;"))?>
       </div>
    </div>
    <?php 
    
    ?>
</div>
<div class="row">
    <div class="col-sm-12">
        <p> <?php echo $data->text; ?></p>

        <p style="display: inline-block;"><?php echo CHtml::link(
                "Редактировать",
                array('/backend/review/review/update/'.$data->id )
            ); ?></p>
			
		<p style="display: inline-block;"> или </p>
            
        <p style="display: inline-block;"><?php echo CHtml::link(
                "Показать на сайте",
                array('/review/show?id='.$data->id ),
				array('target' => '_blank')
            ); ?>
        </p>		
            
        <p style="display: inline-block;"><?php echo CHtml::link(
                "Удалить",
                array('/backend/review/review/delete/'.$data->id ),
                array('style' => 'color:#F00;')
            ); ?>
         </p>
            
    </div>
</div>

<hr>
</div>