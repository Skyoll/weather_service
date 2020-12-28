<?php


namespace FM\WeatherService;


class SendResponse
{
    /** @var int $temp */
    private $temp;

    /** @var int $feelsLike */
    private $feelsLike;

    /** @var int $tempMin */
    private $tempMin;

    /** @var int $tempMax */
    private $tempMax;

    public function __construct($temp, $feelsLike, $tempMin, $tempMax)
    {
        $this->temp = $temp;
        $this->feelsLike = $feelsLike;
        $this->tempMin = $tempMin;
        $this->tempMax = $tempMax;
    }

    /**
     * @return int
     */
    public function getTemp()
    {
        return $this->temp;
    }

    /**
     * @return int
     */
    public function getFeelsLike()
    {
        return $this->feelsLike;
    }

    /**
     * @return int
     */
    public function getTempMin()
    {
        return $this->tempMin;
    }

    /**
     * @return int
     */
    public function getTempMAX()
    {
        return $this->tempMax;
    }
}