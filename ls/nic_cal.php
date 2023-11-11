<?php

if (strlen($nic) == 10) {
    $year = intval('19' . $nic[0] . $nic[1]);
    $daysVal = intval($nic[2] . $nic[3] . $nic[4]);

} else {
    $year = intval($nic[0] . $nic[1] . $nic[2] . $nic[3]);
    $daysVal = intval($nic[4] . $nic[5] . $nic[6]);

}

if ($daysVal > 500) {
    $gender = "Female";
    $daysVal = $daysVal - 500;

} else {
    $gender = "Male";
}

if ($daysVal < 1 and $daysVal > 366) {

    $nicErr = "Incorrect 'NIC' number";

} else {
    // Month
    if ($daysVal > 335) {
        $day = $daysVal - 335;
        $month = "12";

    } else if ($daysVal > 305) {
        $day = $daysVal - 305;
        $month = "11";

    } else if ($daysVal > 274) {
        $day = $daysVal - 274;
        $month = "10";

    } else if ($daysVal > 244) {
        $day = $daysVal - 244;
        $month = "09";

    } else if ($daysVal > 213) {
        $day = $daysVal - 213;
        $month = "08";

    } else if ($daysVal > 182) {
        $day = $daysVal - 182;
        $month = "07";

    } else if ($daysVal > 152) {
        $day = $daysVal - 152;
        $month = "06";

    } else if ($daysVal > 121) {
        $day = $daysVal - 121;
        $month = "05";

    } else if ($daysVal > 91) {
        $day = $daysVal - 91;
        $month = "04";

    } else if ($daysVal > 60) {
        $day = $daysVal - 60;
        $month = "03";

    } else if ($daysVal < 32) {
        $month = "01";
        $day = $daysVal;
    } else if ($daysVal > 31) {
        $day = $daysVal - 31;
        $month = "02";
    }
}

$dob = strval($year . '-' . $month . '-' . $day);

?>