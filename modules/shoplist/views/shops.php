<?php

use irim\yandex\maps\YandexMaps;

?>
<div class="yandex-map">
    <div class="width-block">
        <div class="article">
            <h1>Розничные магазины</h1>
        </div>
    </div>
    <div class="yandex-map-block">
        <?= YandexMaps::widget([
            'id' => 'myNewMap',
            'style' => 'width:100%; height: 400px',
            'map' => [
                'type' => \irim\yandex\maps\YandexMaps::TYPE_DEFAULT,
                'controls' => false,
                'zoom' => 16,
                'center' => [55.044396, 82.905324]
            ],
            'placemarks' => $citiesList,
            'clusters'=>TRUE
        ]);
        ?>
    </div>

    <div class="width-block shops-block">
        <?php if ($cities) { ?>
            <?php foreach ($cities as $city) { ?>
                <div class="shop-block">
                    <h2><?= $city->title ?></h2>
                    <?php if ($city->shops) { ?>
                        <?php foreach ($city->shops as $shop) { ?>
                            <div><?= $shop->title ?></div>
                        <?php } ?>
                    <?php } ?>
                </div>
            <?php } ?>
        <?php } ?>
    </div>
</div>
