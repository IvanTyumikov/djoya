<?php

/**
 * 
 */
Yii::import('application.components.MyHtml');
class MyClientScript extends CClientScript
{
	/**
	 * Composes script HTML block from the given script values,
	 * attempting to group scripts at single 'script' tag if possible.
	 * @param array $scripts script values to process.
	 * @return string HTML output
	 */
	protected function renderScriptBatch(array $scripts)
	{
		$html = '';
		$scriptBatches = array();
		foreach($scripts as $scriptValue)
		{
			if(is_array($scriptValue))
			{
				$scriptContent = $scriptValue['content'];
				unset($scriptValue['content']);
				$scriptHtmlOptions = $scriptValue;
				ksort($scriptHtmlOptions);
			}
			else
			{
				$scriptContent = $scriptValue;
				$scriptHtmlOptions = array();
			}
			$key=serialize($scriptHtmlOptions);
			$scriptBatches[$key]['htmlOptions']=$scriptHtmlOptions;
			$scriptBatches[$key]['scripts'][]=$scriptContent;
		}
		foreach($scriptBatches as $scriptBatch)
			if(!empty($scriptBatch['scripts']))
				$html.=MyHtml::script(implode("\n",$scriptBatch['scripts']),$scriptBatch['htmlOptions'])."\n";
		return $html;
	}

	/**
	 * Inserts the scripts in the head section.
	 * @param string $output the output to be inserted with scripts.
	 */
	public function renderHead(&$output)
	{
		$html='';
		foreach($this->metaTags as $meta)
			$html.=MyHtml::metaTag($meta['content'],null,null,$meta)."\n";
		foreach($this->linkTags as $link)
			$html.=MyHtml::linkTag(null,null,null,null,$link)."\n";
		foreach($this->cssFiles as $url=>$media)
			$html.=MyHtml::cssFile($url,$media)."\n";
		foreach($this->css as $css)
			$html.=MyHtml::css($css[0],$css[1])."\n";
		if($this->enableJavaScript)
		{
			if(isset($this->scriptFiles[self::POS_HEAD]))
			{
				foreach($this->scriptFiles[self::POS_HEAD] as $scriptFileValueUrl=>$scriptFileValue)
				{
					if(is_array($scriptFileValue))
						$html.=MyHtml::scriptFile($scriptFileValueUrl,$scriptFileValue)."\n";
					else
						$html.=MyHtml::scriptFile($scriptFileValueUrl)."\n";
				}
			}

			if(isset($this->scripts[self::POS_HEAD]))
				$html.=$this->renderScriptBatch($this->scripts[self::POS_HEAD]);
		}

		if($html!=='')
		{
			$count=0;
			$output=preg_replace('/(<title\b[^>]*>|<\\/head\s*>)/is','<###head###>$1',$output,1,$count);
			if($count)
				$output=str_replace('<###head###>',$html,$output);
			else
				$output=$html.$output;
		}
	}

	/**
	 * Inserts the scripts at the beginning of the body section.
	 * @param string $output the output to be inserted with scripts.
	 */
	public function renderBodyBegin(&$output)
	{
		$html='';
		if(isset($this->scriptFiles[self::POS_BEGIN]))
		{
			foreach($this->scriptFiles[self::POS_BEGIN] as $scriptFileUrl=>$scriptFileValue)
			{
				if(is_array($scriptFileValue))
					$html.=MyHtml::scriptFile($scriptFileUrl,$scriptFileValue)."\n";
				else
					$html.=MyHtml::scriptFile($scriptFileUrl)."\n";
			}
		}
		if(isset($this->scripts[self::POS_BEGIN]))
			$html.=$this->renderScriptBatch($this->scripts[self::POS_BEGIN]);

		if($html!=='')
		{
			$count=0;
			$output=preg_replace('/(<body\b[^>]*>)/is','$1<###begin###>',$output,1,$count);
			if($count)
				$output=str_replace('<###begin###>',$html,$output);
			else
				$output=$html.$output;
		}
	}

	/**
	 * Inserts the scripts at the end of the body section.
	 * @param string $output the output to be inserted with scripts.
	 */
	public function renderBodyEnd(&$output)
	{
		if(!isset($this->scriptFiles[self::POS_END]) && !isset($this->scripts[self::POS_END])
			&& !isset($this->scripts[self::POS_READY]) && !isset($this->scripts[self::POS_LOAD]))
			return;

		$fullPage=0;
		$output=preg_replace('/(<\\/body\s*>)/is','<###end###>$1',$output,1,$fullPage);
		$html='';
		if(isset($this->scriptFiles[self::POS_END]))
		{
			foreach($this->scriptFiles[self::POS_END] as $scriptFileUrl=>$scriptFileValue)
			{
				if(is_array($scriptFileValue))
					$html.=MyHtml::scriptFile($scriptFileUrl,$scriptFileValue)."\n";
				else
					$html.=MyHtml::scriptFile($scriptFileUrl)."\n";
			}
		}
		$scripts=isset($this->scripts[self::POS_END]) ? $this->scripts[self::POS_END] : array();
		if(isset($this->scripts[self::POS_READY]))
		{
			if($fullPage)
				$scripts[]="jQuery(function($) {\n".implode("\n",$this->scripts[self::POS_READY])."\n});";
			else
				$scripts[]=implode("\n",$this->scripts[self::POS_READY]);
		}
		if(isset($this->scripts[self::POS_LOAD]))
		{
			if($fullPage)
				$scripts[]="jQuery(window).on('load',function() {\n".implode("\n",$this->scripts[self::POS_LOAD])."\n});";
			else
				$scripts[]=implode("\n",$this->scripts[self::POS_LOAD]);
		}
		if(!empty($scripts))
			$html.=$this->renderScriptBatch($scripts);

		if($fullPage)
			$output=str_replace('<###end###>',$html,$output);
		else
			$output=$output.$html;
	}
}