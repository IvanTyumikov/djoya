<?php
/**
 * TbCrumb class file.
 * @author Christoffer Niska <ChristofferNiska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2011-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package bootstrap.widgets
 */

Yii::import('bootstrap.widgets.TbBreadcrumbs');
/**
 * Bootstrap breadcrumb widget.
 * @see http://twitter.github.com/bootstrap/components.html#breadcrumbs
 */
class MyTbBreadcrumbs extends TbBreadcrumbs
{
	/**
	 * @var string the separator between links in the breadcrumbs. Defaults to '/'.
	 */
	public $separator = '/';

	/**
	 * Initializes the widget.
	 */
	public function init()
	{
		$this->htmlOptions['itemscope'] = true;
		$this->htmlOptions['itemtype'] = "http://schema.org/BreadcrumbList";
	}

	/**
	 * Renders the content of the widget.
	 * @throws CException
	 */
	public function run()
	{
		// Hide empty breadcrumbs.
		if (empty($this->links))
			return;

		$links = array();

		if (!isset($this->homeLink))
		{
			$content = CHtml::link("<span itemprop='name'>" . Yii::t('zii', 'Home') . "</span><meta itemprop='position' content='1'>", Yii::app()->homeUrl, array("itemtype" => "http://schema.org/Thing","itemprop" => "item"));
			$links[] = $this->renderItem($content);
		}
		else if ($this->homeLink !== false)
			$links[] = $this->renderItem("<span itemprop='name'>". $this->homeLink . "</span>");

		$count = 2;
		foreach ($this->links as $label => $url)
		{
			if (is_string($label) || is_array($url))
			{
				$res = "<span itemprop='name'>" . $label . "</span>";
				$res .= "<meta itemprop='position' content='{$count}'>";
				$content = CHtml::link($res, $url, array("itemtype" => "http://schema.org/Thing","itemprop" => "item"));
				$links[] = $this->renderItem($content);
			}
			else
				$links[] = $this->renderItem($this->encodeLabel ? CHtml::encode($url) : $url, true);

			$count++;
		}

		echo CHtml::tag('ul', $this->htmlOptions, implode('', $links));
	}

	/**
	 * Renders a single breadcrumb item.
	 * @param string $content the content.
	 * @param boolean $active whether the item is active.
	 * @return string the markup.
	 */
	protected function renderItem($content, $active = false)
	{
		$lirasm = array("itemscope" => true, "itemprop" => "itemListElement", "itemtype" => "http://schema.org/ListItem");
		ob_start();
		echo CHtml::openTag('li', $active ? array_merge(array('class'=>'active')) : $lirasm);
		echo $content;
		echo '</li>';
		return ob_get_clean();
	}
}
