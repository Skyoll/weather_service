<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<table>
    <tr>
        <td>
            Температура: <?=$arResult['WEATHER_DATA']["temp"]?> F
        </td>
        <td>
            Ощущается как: <?=$arResult['WEATHER_DATA']["feelsLike"]?> F
        </td>
        <td>
            Максимальная температура: <?=$arResult['WEATHER_DATA']["tempMin"]?> F
        </td>
        <td>
            Мминимальная температура: <?=$arResult['WEATHER_DATA']["tempMax"]?> F
        </td>
    </tr>
</table>

