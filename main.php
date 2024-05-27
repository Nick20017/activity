<?php

require_once('./includes/ActivityType.php');
require_once('./includes/OutputType.php');
require_once('./includes/Config.php');
require_once('./includes/Request.php');
require_once('./includes/Activity.php');
require_once('./includes/OutputWriter.php');

do {
    try {
        echo('Enter amount of participants (1-8) (Optional): ');
        $participants = trim(fgets(STDIN));

        if (empty($participants)) break;

        if (!is_numeric($participants)) {
            echo('You\'ve entered invalid value. ');
            $participants = -1;
        } else {
            $participants = (int)$participants;
        }
    } catch (TypeError $e) {
        echo('You\'ve entered invalid value. ');
        $participants = -1;
    }
} while ($participants < 1 || $participants > 8);

do {
    echo('Enter activity type. Allowed values are (education, recreational, social, diy, charity, cooking, relaxation, music, busywork) (Optional): ');
    $activityType = trim(fgets(STDIN));

    if (empty($activityType)) break;
} while (!ActivityType::getType($activityType));

do {
    echo('Enter output type. Allowed values are (file, console) (Required): ');
    $outputType = trim(fgets(STDIN));
} while(!($outputTypeEnum = OutputType::getType($outputType)));

$request = new Request(Config::getActivityAPI() . '?participants=' . $participants . '&type=' . strtolower($activityType));
$request->get();

if ($json = $request->getJson()) {
    $activity = new Activity($json);
    
    $writer = new OutputWriter($outputTypeEnum);
    $writer->write($activity->getRandomActivity());
}