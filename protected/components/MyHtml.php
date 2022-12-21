<?php

/**
 * 
 */
class MyHtml extends CHtml
{

	// Добавляем в htmlOptions array для Radio buttons
	public static function radioButtonList($name,$select,$data,$htmlOptions=array())
	{
		$template=isset($htmlOptions['template'])?$htmlOptions['template']:'{input} {label}';
		$separator=isset($htmlOptions['separator'])?$htmlOptions['separator']:self::tag('br');
		$container=isset($htmlOptions['container'])?$htmlOptions['container']:'span';
		$itemOptions=isset($htmlOptions['itemOptions'])?$htmlOptions['itemOptions']:[];
		unset($htmlOptions['template'],$htmlOptions['separator'],$htmlOptions['container'], $htmlOptions['itemOptions']);

		$labelOptions=isset($htmlOptions['labelOptions'])?$htmlOptions['labelOptions']:array();
		unset($htmlOptions['labelOptions']);

		if(isset($htmlOptions['empty']))
		{
			if(!is_array($htmlOptions['empty']))
				$htmlOptions['empty']=array(''=>$htmlOptions['empty']);
			$data=CMap::mergeArray($htmlOptions['empty'],$data);
			unset($htmlOptions['empty']);
		}

		$items=array();
		$baseID=isset($htmlOptions['baseID']) ? $htmlOptions['baseID'] : self::getIdByName($name);
		unset($htmlOptions['baseID']);
		$id=0;
		foreach($data as $value=>$labelTitle)
		{
			$itemOption=isset($itemOptions[$value])?$itemOptions[$value]:[];
			$checked=!strcmp($value,$select);
			$htmlOptions['value']=$value;
			$htmlOptions['id']=$baseID.'_'.$id++;
			$option=self::radioButton($name,$checked,$htmlOptions+$itemOption);
			$beginLabel=self::openTag('label',$labelOptions);
			$labelAmount = '<span class="amount"></span>';
			$label=self::label('<span class="value">'.$labelTitle['attribute_value'].''.$labelTitle['unit'].'</span>'.$labelAmount,$htmlOptions['id'],$labelOptions);
			$endLabel=self::closeTag('label');
			$items[]=strtr($template,array(
				'{input}'=>$option,
				'{beginLabel}'=>$beginLabel,
				'{label}'=>$label,
				'{labelTitle}'=>$labelTitle,
				'{endLabel}'=>$endLabel,
			));
		}
		if(empty($container))
			return implode($separator,$items);
		else
			return self::tag($container,array('id'=>$baseID),implode($separator,$items));
	}
	
	public static function script($text,array $htmlOptions=array())
	{
		$defaultHtmlOptions=array(
		);
		$htmlOptions=array_merge($defaultHtmlOptions,$htmlOptions);
		return self::tag('script',$htmlOptions,"\n/*<![CDATA[*/\n{$text}\n/*]]>*/\n");
	}

	/**
	 * Includes a JavaScript file.
	 * @param string $url URL for the JavaScript file
	 * @param array $htmlOptions additional HTML attributes (see {@link tag})
	 * @return string the JavaScript file tag
	 */
	public static function scriptFile($url,array $htmlOptions=array())
	{
		$defaultHtmlOptions=array(
			'src'=>$url
		);
		$htmlOptions=array_merge($defaultHtmlOptions,$htmlOptions);
		return self::tag('script',$htmlOptions,'');
	}
}