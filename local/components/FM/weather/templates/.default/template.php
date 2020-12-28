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
<form id="weather">
    <p>
        <select size="10"  name="city">
            <option disabled>Выберите город</option>
            <?php foreach ($arResult['CITIES'] as $city): ?>
            <option value="<?= $city?>"><?= $city?></option>
            <?php endforeach; ?>
        </select></p>
    <p>
        <input class='submitForm' type="submit" value="Отправить"></p>
</form>

<span class="response"></span>

<script>
    $( document ).ready(function() {
        $("#weather").on("submit", function(e){
            e.preventDefault();
            $('.response').html('');
            var $city = $('select[name=city] option').filter(':selected').val()

            console.log($city);
            $.ajax({
                type: "POST",
                url: "/ajax/weather_ajax.php",
                data: {
                    'city': $city
                },
                dataType: "json",
                success: function(data){
                    $('.response').append(data.weather)
                    },
                error: function(errMsg) {
                    console.log('errMsg');
                }
            });
        });
    });
</script>
