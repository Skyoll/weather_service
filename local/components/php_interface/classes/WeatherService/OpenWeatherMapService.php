<?php


namespace FM\WeatherService;


use Bitrix\Main\Web\HttpClient;

class OpenWeatherMapService implements WeatherServiceInterface
{
    private $accessKey;
    const REQUEST_SEND_URL = 'http://api.openweathermap.org/data/2.5/weather?q=%s&appid=%s';

    public function __construct($accessKey)
    {
        $this->accessKey = $accessKey;
    }

    /**
     * @param string $cityName
     * @return SendResponse
     */
    public function send($cityName)
    {
        $url = sprintf(self::REQUEST_SEND_URL, $cityName, $this->accessKey);

        $data = $this->sendRequest($url);
        return new SendResponse(
            $data['main']['temp'],
            $data['main']['feels_like'],
            $data['main']['temp_min'],
            $data['main']['temp_max']
        );
    }

    /**
     * @param $url
     * @return array
     */
    private function sendRequest($url)
    {

        $httpClient = new HttpClient();
        $data = $httpClient->get($url);
        $data = json_decode($data, true);
        return $data;
    }

}