<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Http\Controllers\ScheduleAction;

class ScheduleServiceTest extends TestCase
{
    protected ScheduleAction $scheduleAction;

    protected function setUp(): void
    {
        parent::setUp();
        $this->scheduleAction = new ScheduleAction();
    }

    /**
     * @dataProvider itemsDataProvider
     */
    public function test_getSchedules($date_time, $type, $object, $expectedResult)
    {
        $result = $this->scheduleAction->get_schedule($date_time, $type, $object);
        $this->assertEquals($expectedResult, $result);
    }

    public function itemsDataProvider()
    {
        $date = date('d/m/Y');
        return [
            'case1' => [
                $date .' 11:59', 'L1', 1, //data test
                ['train_name' => 'SE2', 'time' => '12:00', 'price' => 135000] // expect result
            ],
            'case2' => [
                $date .' 11:59', 'L1', 2,
                ['train_name' => 'SE2', 'time' => '12:00', 'price' => 120000]
            ],
            'case3' => [
                $date .' 11:59', 'L1', 3,
                ['train_name' => 'SE2', 'time' => '12:00', 'price' => 75000]
            ],
            'case4' => [
                $date .' 11:59', 'L1', 4,
                ['train_name' => 'SE2', 'time' => '12:00', 'price' => 150000]
            ],
            'case5' => [
                $date .' 11:59', 'L2', 1,
                ['train_name' => 'SE2', 'time' => '12:00', 'price' => 225000]
            ],
            'case6' => [
                $date .' 11:59', 'L2', 2,
                ['train_name' => 'SE2', 'time' => '12:00', 'price' => 200000]
            ],
            'case7' => [
                $date .' 11:59', 'L2', 3,
                ['train_name' => 'SE2', 'time' => '12:00', 'price' => 125000]
            ],
            'case8' => [
                $date .' 11:59', 'L2', 4,
                ['train_name' => 'SE2', 'time' => '12:00', 'price' => 250000]
            ],
            'case8' => [
                $date .' 11:59', 'L3', 1,
                ['train_name' => 'SE2', 'time' => '12:00', 'price' => 153000]
            ],
            'case9' => [
                $date .' 11:59', 'L3', 2,
                ['train_name' => 'SE2', 'time' => '12:00', 'price' => 136000]
            ],
            'case10' => [
                $date .' 11:59', 'L3', 3,
                ['train_name' => 'SE2', 'time' => '12:00', 'price' => 85000]
            ],
            'case11' => [
                $date .' 11:59', 'L3', 4,
                ['train_name' => 'SE2', 'time' => '12:00', 'price' => 170000]
            ],
            'case12' => [
                $date .' 07:29', 'L1', 1, //data test
                [['train_name' => 'SE1', 'time' => '08:30', 'price' =>90000],['train_name' => 'SE2', 'time' => '12:00', 'price' => 135000]] // expect result
            ],
            'case13' => [
                $date .' 07:29', 'L1', 2,
                [['train_name' => 'SE1', 'time' => '08:30', 'price' =>80000],['train_name' => 'SE2', 'time' => '12:00', 'price' => 120000]]
            ],
            'case14' => [
                $date .' 07:29', 'L1', 3,
                [['train_name' => 'SE1', 'time' => '08:30', 'price' =>50000],['train_name' => 'SE2', 'time' => '12:00', 'price' => 75000]]
            ],
            'case15' => [
                $date .' 07:29', 'L1', 4,
                [['train_name' => 'SE1', 'time' => '08:30', 'price' =>100000],['train_name' => 'SE2', 'time' => '12:00', 'price' => 150000]]
            ],
            'case16' => [
                $date .' 07:29', 'L2', 1,
                [['train_name' => 'SE1', 'time' => '08:30', 'price' =>180000],['train_name' => 'SE2', 'time' => '12:00', 'price' => 225000]]
            ],
            'case17' => [
                $date .' 07:29', 'L2', 2,
                [['train_name' => 'SE1', 'time' => '08:30', 'price' =>160000],['train_name' => 'SE2', 'time' => '12:00', 'price' => 200000]]
            ],
            'case18' => [
                $date .' 07:29', 'L2', 3,
                [['train_name' => 'SE1', 'time' => '08:30', 'price' =>100000],['train_name' => 'SE2', 'time' => '12:00', 'price' => 125000]]
            ],
            'case19' => [
                $date .' 07:29', 'L2', 4,
                [['train_name' => 'SE1', 'time' => '08:30', 'price' =>200000],['train_name' => 'SE2', 'time' => '12:00', 'price' => 250000]]
            ],
            'case20' => [
                $date .' 07:29', 'L3', 1,
                [['train_name' => 'SE1', 'time' => '08:30', 'price' =>135000],['train_name' => 'SE2', 'time' => '12:00', 'price' => 153000]]
            ],
            'case21' => [
                $date .' 07:29', 'L3', 2,
                [['train_name' => 'SE1', 'time' => '08:30', 'price' =>120000],['train_name' => 'SE2', 'time' => '12:00', 'price' => 136000]]
            ],
            'case22' => [
                $date .' 07:29', 'L3', 3,
                [['train_name' => 'SE1', 'time' => '08:30', 'price' =>75000],['train_name' => 'SE2', 'time' => '12:00', 'price' => 85000]]
            ],
            'case23' => [
                $date .' 07:29', 'L3', 4,
                [['train_name' => 'SE1', 'time' => '08:30', 'price' =>150000],['train_name' => 'SE2', 'time' => '12:00', 'price' => 170000]]
            ],
            //exception
            'case24' => [
                $date .' 12:01', 'L1', 1,
                ['message' => 'none data']
            ],
            'case25' => [
                $date .' 11:01', 'L1', 5,
                ['message' => 'invalid input coupon']
            ],
            'case26' => [
                $date .' 11:01', 'L5', 1,
                ['message' => 'invalid input type']
            ],
            'case27' => [
                date('d/m/Y', strtotime("-1 day")) .' 11:59', 'L1', 1,
                ['message' => 'invalid input datetime']
            ],
        ];
    }
}
