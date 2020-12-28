<?php


class Weather extends \CBitrixComponent
{
    const CACHE_TIME = 3600;

    public $componentParams = [];
    private $arCities;

    public function onPrepareComponentParams($params)
    {
        !$params['CACHE_TIME'] && $params['CACHE_TIME'] = self::CACHE_TIME;
        !in_array($params['CACHE_TYPE'], ['A', 'N', 'Y']) && $params['CACHE_TYPE'] = 'A';

        $this->arCities = (array) $params['cities'];

        return $params;
    }

    public function executeComponent()
    {
        try {
            if ($this->startResultCache($this->arParams['CACHE_TIME'])) {
                $this->setResultCacheKeys(['CITIES']);
                $this->arResult['CITIES'] = $this->getCities();
                $this->includeComponentTemplate();
            }
        } catch (\Exception $e) {
            $this->abortResultCache();
        }
    }

    private function getCities()
    {
        return $this->arCities;
    }
}
