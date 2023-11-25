<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScheduleRequest;
use Illuminate\Support\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;

class ScheduleAction extends Controller
{
    //
    public function __invoke(ScheduleRequest $request)
    {
        $res = [];
        $res = $this->get_schedule($request->date_time_start, $request->type, $request->coupon, $request->qty);
        return response()->json($res);
    }

    public function get_schedule(string $date_time, string $type, int $object, $qty = 1): array
    {
        $res = [];
        if ($object > 4 || $object < 1) {
            return [
                'message' => 'invalid input coupon'
            ];
        }
        $ar_type = ['L1', 'L2', 'L3'];
        if (!in_array($type, $ar_type)) {
            return [
                'message' => 'invalid input type'
            ];
        }

        $dateTime = Carbon::createFromFormat('d/m/Y H:i', $date_time);
        // $current_time = intval(date('Hi'));
        $current_time = 0;
        if (!$dateTime || $dateTime->format('d/m/Y H:i') !== $date_time || intval($dateTime->format('dmY')) <  intval(date('dmY')) || intval($dateTime->format('Hi')) < $current_time) {
            return [
                'message' => 'invalid input datetime'
            ];
        }
        $time = intval($dateTime->format('Hi'));

        if ($time <= 1200) {
            if ($time > 830) {
                if ($type === 'L1') {
                    if ($object === 1) {
                        $price = $this->calc_price(150000, 10, $qty);
                    } else {
                        if ($object === 2) {
                            $price = $this->calc_price(150000, 20, $qty);
                        } else {
                            if ($object === 3) {
                                $price = $this->calc_price(150000, 50, $qty);
                            } else {
                                $price =  $this->calc_price(150000, 0, $qty);
                            }
                        }
                    }
                } else {
                    if ($type === 'L2') {
                        if ($object === 1) {
                            $price = $this->calc_price(250000, 10, $qty);
                        } else {
                            if ($object === 2) {
                                $price = $this->calc_price(250000, 20, $qty);
                            } else {
                                if ($object === 3) {
                                    $price = $this->calc_price(250000, 50, $qty);
                                } else {
                                    $price =  $this->calc_price(250000, 0, $qty);
                                }
                            }
                        }
                    } else {
                        if ($object === 1) {
                            $price = $this->calc_price(170000, 10, $qty);
                        } else {
                            if ($object === 2) {
                                $price = $this->calc_price(170000, 20, $qty);
                            } else {
                                if ($object === 3) {
                                    $price = $this->calc_price(170000, 50, $qty);
                                } else {
                                    $price =  $this->calc_price(170000, 0, $qty);
                                }
                            }
                        }
                    }
                }
                //result
                $res = [
                    'train_name' => 'SE2',
                    'time' => '12:00',
                    'price' =>  $price
                ];
            } else {
                if ($type === 'L1') {
                    if ($object === 1) {
                        $price1 = $this->calc_price(100000, 10, $qty);
                        $price2 = $this->calc_price(150000, 10, $qty);
                    } else {
                        if ($object === 2) {
                            $price1 = $this->calc_price(100000, 20, $qty);
                            $price2 = $this->calc_price(150000, 20, $qty);
                        } else {
                            if ($object === 3) {
                                $price1 = $this->calc_price(100000, 50, $qty);
                                $price2 = $this->calc_price(150000, 50, $qty);
                            } else {
                                $price1 = $this->calc_price(100000, 0, $qty);
                                $price2 = $this->calc_price(150000, 0, $qty);
                            }
                        }
                    }
                } else {
                    if ($type === 'L2') {
                        if ($object === 1) {
                            $price1 = $this->calc_price(200000, 10, $qty);
                            $price2 = $this->calc_price(250000, 10, $qty);
                        } else {
                            if ($object === 2) {
                                $price1 = $this->calc_price(200000, 20, $qty);
                                $price2 = $this->calc_price(250000, 20, $qty);
                            } else {
                                if ($object === 3) {
                                    $price1 = $this->calc_price(200000, 50, $qty);
                                    $price2 = $this->calc_price(250000, 50, $qty);
                                } else {
                                    $price1 =  $this->calc_price(200000, 0, $qty);
                                    $price2 =  $this->calc_price(250000, 0, $qty);
                                }
                            }
                        }
                    } else {
                        if ($object === 1) {
                            $price1 = $this->calc_price(150000, 10, $qty);
                            $price2 = $this->calc_price(170000, 10, $qty);
                        } else {
                            if ($object === 2) {
                                $price1 = $this->calc_price(150000, 20, $qty);
                                $price2 = $this->calc_price(170000, 20, $qty);
                            } else {
                                if ($object === 3) {
                                    $price1 = $this->calc_price(150000, 50, $qty);
                                    $price2 = $this->calc_price(170000, 50, $qty);
                                } else {
                                    $price1 = $this->calc_price(150000, 0, $qty);
                                    $price2 =  $this->calc_price(170000, 0, $qty);
                                }
                            }
                        }
                    }
                }
                //result
                $res = [
                    [
                        'train_name' => 'SE1',
                        'time' => '08:30',
                        'price' =>  $price1
                    ],
                    [
                        'train_name' => 'SE2',
                        'time' => '12:00',
                        'price' =>  $price2
                    ]
                ];
            }
        } else {
            return [
                'message' => 'none data'
            ];
        }

        return $res;
    }

    function calc_price(int $price, int $percent, int $qty)
    {
        return $price * $qty * (100 - $percent) / 100;
    }
}
