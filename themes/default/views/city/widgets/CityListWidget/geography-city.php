<?php $this->widget(
	// 'application.components.FtListView', [
	'bootstrap.widgets.TbListView',[
    'id' => 'geography-city'.$id,
    'itemView'      => '../../city/_item',
    'dataProvider'  => $dataProvider,
    'itemsCssClass' => 'geography-company-city fl fl-wr-w',
    'template'      => '{items}{pager}',
    'htmlOptions' => [
        "class" => "geography-city-list"
    ],
    'pagerCssClass' => 'pagination-box',
    // 'emptyText' => '',
    // 'emptyTagName' => 'div',
    'pager' => [
        'class' => 'application.components.ShowMorePager',
        'buttonText' => 'Показать еше',
        'wrapTag' => 'div',
        'htmlOptions' => [
            'class' => 'pagination-link-pager'
        ],
        'wrapOptions' => [
            'class' => 'pagination-button'
        ],
    ]
]); ?>