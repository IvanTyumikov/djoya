<?php

/**
 * Class PageUrlRule
 */
class PageUrlRule extends CBaseUrlRule
{
    const CACHE_KEY = 'page::slugs';

    private function getParentPage($slug){
 
        $page = Page::model()->findBySlug($slug);
 
         if(!empty($page->parent_id)){
            $pageParent = Page::model()->findByPk($page->parent_id);
            return $pageParent->slug;
         }
        
        return true;
    }
    
    /**
     * @param CUrlManager $manager
     * @param string $route
     * @param array $params
     * @param string $amp
     * @return bool
     */
    public function createUrl($manager, $route, $params, $amp)
    {
        if ($route === 'page/page/view' && isset($params['city']) && isset($params['slug'])) {
            return $params['city'].'/'.ltrim($params['slug'], '/');
        }
        if ($route === 'page/page/view' && isset($params['slug'])) {
            return $params['slug'];
        }

        return false;
    }

    /**
     * @param \yupe\components\urlManager\LangUrlManager $manager
     * @param CHttpRequest $request
     * @param string $pathInfo
     * @param string $rawPathInfo
     * @return bool|string
     */
    public function parseUrl($manager, $request, $pathInfo, $rawPathInfo){
        
        $slugs = Yii::app()->getCache()->get(self::CACHE_KEY);
 
        if (false === $slugs) {

            $slugs = Yii::app()->getDb()->createCommand()
                ->setFetchMode(PDO::FETCH_COLUMN, 0)
                ->from('{{page_page}}')
                ->select('slug')
                ->queryAll();
 
            Yii::app()->getCache()->set(self::CACHE_KEY, $slugs, 0);
        }

        if(stristr($pathInfo, 'optovikam')){
            $parseUrl = explode('/', $pathInfo);
            $slug = array_pop($parseUrl);            
        }else{
            $slug = $manager->removeLangFromUrl($pathInfo);
        }

        if (in_array($slug, $slugs, true)) {
            return 'page/page/view/slug/' . $slug;
        }

        return false;
    }
}