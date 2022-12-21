<?php $this->beginContent('//layouts/main'); ?>
    
    <?php 
//        $indexCartCss = $this->mainAssets . "/css/index-cart.css";
//        $indexCartCss = $indexCartCss . "?v-" . filectime(Yii::getPathOfAlias('public') . $indexCartCss);
//        Yii::app()->getClientScript()->registerCssFile($indexCartCss);

        Yii::app()->clientScript->registerScriptFile('https://api-maps.yandex.ru/2.1/?apikey=ea202fb1-5d15-4aad-ae8d-c1830c8bc01c&lang=ru_RU', CClientScript::POS_END);
        
     ?>
     
    <?= $content; ?>
    
    <div class="preloader">
	    <div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
	</div>
<?php $this->endContent(); ?>
