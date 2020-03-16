<?php

namespace App;

use DateInterval;
use DateTimeImmutable;

/**
 * @param DateTimeImmutable $dt1
 * @param DateTimeImmutable $dt2
 * @return int количество вторников между двумя датами (включая сами даты) или 0, если вторников нет
 */
function tuesdays_between(DateTimeImmutable $dt1, DateTimeImmutable $dt2): int
{
    $firstTuesday = null;
    while ($dt1 <= $dt2) {
        if ($dt1->format('N') === '2') {
            $firstTuesday = $dt1;
            break;
        }
        $dt1 = $dt1->add(new DateInterval('P1D'));
    }
    if (null === $firstTuesday) {
        return 0;
    }
    $diff = $dt2->diff($firstTuesday, true);

    $diffDays = (int)$diff->format('%a');

    return 1 + $diffDays / 7;
}
