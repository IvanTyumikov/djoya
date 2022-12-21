<?php $this->widget(
     'application.components.MyCMenu',
     [
         'encodeLabel' => false,
         'items' => $this->params['items'],
         'htmlOptions' => [
            'class' => 'footer-nav__nav',
         ],
     ]
 ); ?>