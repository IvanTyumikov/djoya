<?php

/**
 * ShowMorePager
 */
class ShowMorePager extends CLinkPager
{
    public $buttonText = 'Показать еще';
    public $htmlOptions = [];
    public $wrapTag = null;
    public $wrapOptions = [];

    public function run()
    {
        $this->registerClientScript();

        list ($beginPage, $endPage) = $this->getPageRange();

        $currentPage = $this->getCurrentPage(false);

        if ($endPage <= 0) {
            return ;
        }

        $nextPage = $currentPage + 1;

        if ($nextPage <= $endPage) {
            if ($this->wrapTag) {
                echo CHtml::openTag($this->wrapTag, $this->wrapOptions);
            }
            echo CHtml::link($this->buttonText, $this->createPageUrl($nextPage), $this->htmlOptions);
            if ($this->wrapTag) {
                echo CHtml::closeTag($this->wrapTag);
            }
        }

        return ;
    }
}
