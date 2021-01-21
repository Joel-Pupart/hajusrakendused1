<?php

$apiKey = "99a5daba36d1af32fbaa9a8f392ce454";
$cityId = "658225";
$googleApiUrl = "http://api.openweathermap.org/data/2.5/weather?id=" . $cityId . "&lang=en&units=metric&APPID=" . $apiKey;

$file = 'cache.json';

$fileInfo = filemtime($file);

if (!file_exists($file) || $fileInfo + 60 > time()) {
    $data = file_get_contents($googleApiUrl);
    $json = json_decode($data, true);
    file_put_contents('cache.json', json_encode($json));
}

$json = json_decode(file_get_contents($file));
$currentTime = time();

/*
print_r($json);
print_r(date("Y-m-d, H:i:s", $fileInfo));*/
?>

<!doctype html>
<html>
<head>
<title>Hajusrakendused ülesanne 1</title>
<link rel="stylesheet" href="style.css">

</head>
<body>

    <div class="report-container">
        <h2><?php echo $json->name; ?> Weather Status</h2>
        <div class="time">
            <div><?php echo date("l g:i a", $currentTime); ?></div>
            <div><?php echo date("jS F, Y",$currentTime); ?></div>
            <div><?php echo ucwords($json->weather[0]->description); ?></div>
        </div>
        <div class="weather-forecast">
            <img
                src="http://openweathermap.org/img/w/<?php echo $json->weather[0]->icon; ?>.png"
                class="weather-icon" /> <?php echo $json->main->temp_max; ?>&deg;C<span
                class="min-temperature"><?php echo $json->main->temp_min; ?>&deg;C</span>
        </div>
        <div class="time">
            <div>Humidity: <?php echo $json->main->humidity; ?> %</div>
            <div>Wind: <?php echo $json->wind->speed; ?> km/h</div>
        </div>
    </div>


</body>
</html>
