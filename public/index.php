<?php

require_once '../vendor/autoload.php';

use function App\tuesdays_between;

if (isset($_GET['date1'], $_GET['date2'])) {
    $date1 = $_GET['date1'];
    $date2 = $_GET['date2'];

    $dt1 = DateTimeImmutable::createFromFormat(DATE_ATOM, $date1.'T00:00:00Z');
    $dt2 = DateTimeImmutable::createFromFormat(DATE_ATOM, $date2.'T00:00:00Z');

    if (false === $dt1 || false === $dt2) {
        http_response_code(400);
        die('wrong date format, should be "Y-m-d"');
    }
    if ($dt1 > $dt2) { // считаем, что пользователю все равно, в каком порядке вводить даты
        [$dt2, $dt1] = [$dt1, $dt2];
    }
    $tuesdays = tuesdays_between($dt1, $dt2);

    printf(
        'Количество вторников между датами %s—%s (включительно): <strong>%s</strong>.',
        $dt1->format('d.m.Y'),
        $dt2->format('d.m.Y'),
        $tuesdays ?: 'вторников нет'
    );
    exit;
}
?>

<form method="get" action="">
    <input type="date" name="date1" required="required"/>
    <input type="date" name="date2" required="required"/>
    <button type="submit">Go</button>
</form>
