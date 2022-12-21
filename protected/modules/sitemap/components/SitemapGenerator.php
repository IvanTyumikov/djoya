<?php

use samdark\sitemap\Sitemap;

/**
 * Class SitemapGenerator
 */
class SitemapGenerator extends CApplicationComponent
{
    /**
     * @var array
     */
    protected $data = [];

    /**
     * @param $location
     * @param null $lastModified
     * @param null $changeFrequency
     * @param null $priority
     */
    public function addItem($location, $lastModified = null, $changeFrequency = null, $priority = null)
    {
        $this->data[] = [
            'location' => $location,
            'lastModified' => $lastModified,
            'changeFrequency' => $changeFrequency,
            'priority' => $priority,
        ];
    }

    /**
     * @param $sitemapFile
     */
    public function generate($sitemapFile, array $data)
    {
        if (!empty($data)) {
            $this->data = array_merge($this->data, $data);
        }

        $sitemap = new Sitemap($sitemapFile);

        Yii::app()->eventManager->fire(SiteMapEvents::BEFORE_GENERATE, new SiteMapBeforeGenerateEvent($this));

        foreach ($this->data as $item) {
            if ((!stristr($item['location'], 'baktericidnyy-recirkulyator') && stristr($item['location'], 'product')) || (!stristr($item['location'], 'recirkulyatory') && stristr($item['location'], 'store'))) {
                $sitemap->addItem($item['location'], $item['lastModified'], $item['changeFrequency'], $item['priority']);
        
                $cities = Yii::app()->getComponent('cityRepository')->getListCities();
                if (stristr($item['location'], 'store') || stristr($item['location'], 'product')) {
                    foreach ($cities as $key => $city) {
                        $city_loc = str_replace(Yii::app()->getBaseUrl(true), Yii::app()->getBaseUrl(true).'/'.$city, $item['location']);
                        $sitemap->addItem($city_loc, $item['lastModified'], $item['changeFrequency'], $item['priority']);
                    }
                }
            }            
        }
        $sitemap->write();
    }
} 
