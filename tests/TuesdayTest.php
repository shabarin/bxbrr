<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

use function App\tuesdays_between;

class TuesdayTest extends TestCase
{
    /**
     * @dataProvider provider
     */
    public function test_tuesday_between($expected, $dt1, $dt2): void
    {
        $this->assertSame($expected, tuesdays_between($dt1, $dt2));
    }

    public function provider(): array
    {
        return array_map(
            function ($a) {
                return [
                    $a[0],
                    \DateTimeImmutable::createFromFormat(DATE_ATOM, $a[1].'T00:00:00Z'),
                    \DateTimeImmutable::createFromFormat(DATE_ATOM, $a[2].'T00:00:00Z'),
                ];
            },
            [
                [1, '2020-03-08', '2020-03-12'],
                [1, '2020-03-09', '2020-03-10'],
                [1, '2020-03-10', '2020-03-12'],
                [1, '2020-03-10', '2020-03-10'],
                [0, '2020-03-09', '2020-03-09'],
                [0, '2020-03-11', '2020-03-16'],
                [2, '2020-03-10', '2020-03-17'],
                [3, '2020-03-10', '2020-03-24'],
                [3, '2020-03-07', '2020-03-27'],
                [9, '2020-03-01', '2020-04-30'],

                // високосная секунда во вторник 30.06.2015 :)
                [0, '2015-06-28', '2015-06-29'],
                [1, '2015-06-29', '2015-06-30'],
                [1, '2015-06-30', '2015-06-30'],
                [1, '2015-06-30', '2015-07-01'],
                [0, '2015-07-01', '2015-07-03'],
            ]
        );
    }

}
