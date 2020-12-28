<?php

use Bitrix\Main\Localization\Loc;
use FM\WeatherService\WeatherServiceInterface;


class WeatherAjax extends \CBitrixComponent
{
    const CACHE_TIME = 3600;
    /** @var WeatherServiceInterface $whetherService */
    private $whetherService;
    /** @var string $cityName */
    private $cityName;

    public $componentParams = [];

    public function onPrepareComponentParams($params)
    {
        !$params['CACHE_TIME'] && $params['CACHE_TIME'] = self::CACHE_TIME;
        !in_array($params['CACHE_TYPE'], ['A', 'N', 'Y']) && $params['CACHE_TYPE'] = 'A';

        if (!$params['whetherService'] instanceof WeatherServiceInterface) {
            throw new \InvalidArgumentException(Loc::getMessage('INVALID_WHETHER_SERVICE'));
        }
        $this->whetherService = $params['whetherService'];

        if (empty($params['cityName'])) {
            throw new \InvalidArgumentException(Loc::getMessage('INVALID_CITY_NAME'));
        }

        $this->cityName = (string) $params['cityName'];

        return $params;
    }

    public function executeComponent()
    {
        try {
            if ($this->startResultCache($this->arParams['CACHE_TIME'], $this->getAdditionalCacheId())) {
                $this->setResultCacheKeys(['WEATHER_DATA']);
                $this->arResult['WEATHER_DATA'] = $this->getCitiesWhetherData();
                $this->includeComponentTemplate();
            }
        } catch (\Exception $e) {
            $this->abortResultCache();
        }
    }

    private function getAdditionalCacheId()
    {
        return md5($this->cityName);
    }

    /*** @return array */
    private function getCitiesWhetherData()
    {
        $response = $this->whetherService->send($this->cityName);
        if (!$response) {
            throw new \http\Exception\RuntimeException('no weather data');
        }

        return [
            'temp' => $response->getTemp(),
            'feelsLike' => $response->getFeelsLike(),
            'tempMin' => $response->getTempMin(),
            'tempMax' => $response->getTempMAX(),
            'city' => $this->cityName
        ];
    }

}
