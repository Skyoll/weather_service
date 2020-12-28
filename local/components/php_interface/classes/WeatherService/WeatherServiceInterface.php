<?php

namespace FM\WeatherService;

interface WeatherServiceInterface
{
    /***
     * @param string $cityName
     * @return SendResponse
     */
    public function send($cityName);
}