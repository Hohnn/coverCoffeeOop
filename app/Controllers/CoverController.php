<?php

namespace App\Controllers;



class CoverController
{

    public function algo($orders)
    {

        $cover = $this->sortByYear($orders);
        foreach ($cover as $key => $year) {
            $cover[$key]['orders'] = $this->sortByProvider($year['orders']);
            $cover[$key]['totalByTrimestre'] = $this->sortByTrimestre($year['orders']);
            foreach ($cover[$key]['orders'] as $key2 => $provider) {
                $cover[$key]['orders'][$key2]['orders'] = $this->sortByTrimestre($provider['orders']);
            }
            
        }
        return $cover;
    }

    public function sortByYear($orders)
    {
        $years = [];
        foreach ($orders as $order) {
            $year = substr($order->date_order2, 6, 4);
            if (!isset($years[$year])) {
                $years[$year] = [
                    'year' => $year,
                    'total' => $order->quantity_order,
                    'totalByTrimestre' => [],
                    'orders' => [$order]
                ];
            } else {
                $years[$year]['orders'][] = $order;
                $years[$year]['total'] += $order->quantity_order;
            }
        }
        
        return array_reverse($years);
    }


    public function sortByMonth($orders, $year)
    {
        $months = [];
        foreach ($orders as $order) {
            $month = substr($order->date_order2, 3, 2);
            if ($year == substr($order->date_order2, 6, 4)) {
                if (!in_array($month, $months)) {
                    $months[] = $month;
                }
            }
        }
        return $months;
    }

    public function sortByProvider($orders)
    {
        $providers = [];
        foreach ($orders as $order) {
            $provider = $order->name_provider;
            if (!isset($providers[$provider])) {
                $providers[$provider] = [
                    'provider' => $provider,
                    'total' => $order->quantity_order,
                    'orders' => [$order]
                ];
            } else {
                $providers[$provider]['orders'][] = $order;
                $providers[$provider]['total'] += $order->quantity_order;
            }
        }
        return array_reverse($providers);
    }

    public function sortByTrimestre($orders)
    {
        $trimestres = [];
        foreach ($orders as $order) {
            $trimestre = $this->getTrimestre($order->date_order2);
            if (!isset($trimestres[$trimestre])) {
                $trimestres[$trimestre] = [
                    'trimestre' => $trimestre,
                    'total' => $order->quantity_order,
                    'orders' => [$order]
                ];
            } else {
                $trimestres[$trimestre]['orders'][] = $order;
                $trimestres[$trimestre]['total'] += $order->quantity_order;
            }
        }
        return $trimestres;
    }

    public function getTrimestre($date)
    {
        $date = explode('/', $date);
        $month = $date[1];
        if ($month >= 1 && $month <= 3) {
            return 1;
        } elseif ($month >= 4 && $month <= 6) {
            return 2;
        } elseif ($month >= 7 && $month <= 9) {
            return 3;
        } elseif ($month >= 10 && $month <= 12) {
            return 4;
        }
    }

    public function getDeltaByTrimestre($orders)
    {
        $cover = $this->sortByYear($orders);
        $array = [];
        foreach ($cover as $key => $year) {
            $cover[$key]['totalByTrimestre'] = $this->sortByTrimestre($year['orders']);
            
        }
        foreach($cover as $key => $year) {
            foreach ($year['totalByTrimestre'] as $key2 => $trimestre) {
                if ($key - 1 >= 0) {
                    $trimestre = $cover[$key]['totalByTrimestre'][$key2]['total'];
                    $trimestreLastYear = $cover[$key - 1]['totalByTrimestre'][$key2]['total'] ?? 0;
                    if ($trimestreLastYear > 0) {
                        $array[$key][] = $this->formatNum(number_format(($trimestre * 100 / $trimestreLastYear) - 100, 0, '.', ''));
                    }  else {
                        $array[$key][] = null;
                    }
                }
            }
            !empty($array[$key]) ? $array[$key] = array_reverse($array[$key]) : null;
            
        }
        return $array;
    }

    public function getDeltaStack($orders)
    {
        $cover = $this->sortByYear($orders);
        $array = [];
        foreach ($cover as $key => $year) {
            $cover[$key]['totalByTrimestre'] = $this->sortByTrimestre($year['orders']);
            
        }
        foreach($cover as $key => $year) {
            foreach (array_reverse($year['totalByTrimestre']) as $key2 => $trimestre) {
                if ($key - 1 >= 0) {
                    if($key2 > 0){
                        $trimestre = 0;
                        $trimestreLastYear = 0;
                        for ($i=0; $i < $key2 + 1 ; $i++) { 
                            $trimestre += $cover[$key]['totalByTrimestre'][$i + 1]['total'];
                            $trimestreLastYear += $cover[$key - 1]['totalByTrimestre'][$i + 1]['total'] ?? 0;
                        }
                        if ($trimestreLastYear > 0) {
                            $array[$key][] = $this->formatNum(number_format(($trimestre * 100 / $trimestreLastYear) - 100, 0, '.', ''));
                        } else {
                            $array[$key][] = null;
                        }
                    } else {
                        $trimestre = $cover[$key]['totalByTrimestre'][$key2 + 1]['total'];
                        $trimestreLastYear = $cover[$key - 1]['totalByTrimestre'][$key2 + 1]['total'] ?? 0;
                        if ($trimestreLastYear > 0) {
                            $array[$key][] = $this->formatNum(number_format(($trimestre * 100 / $trimestreLastYear) - 100, 0, '.', ''));
                        } else {
                            $array[$key][] = null;
                        }
                    }
                }
            }
            
        }

        return $array;
    }

    public function formatNum($num){
        return sprintf("%+d",$num);
    }
    
    public function getContractCover($contracts)
    {
        $array = [];
        
        foreach($contracts as $contract) {
            if ($contract->quantity_contract != 0) {
                $start = $this->getTrimestre($contract->DATE_START);
                $startYear = substr($contract->DATE_START, 6, 4);
                $end = $this->getTrimestre($contract->DATE_END);
                $endYear = substr($contract->DATE_END, 6, 4);
                
                $b = $startYear;
                $a = 1;
                $iStart = $start;
                $iEnd = $end;

                if($startYear != $endYear){
                    $iEnd = 4;
                }
                
                while ($a <= $contract->quantity_contract) {
                    for ($i=$iStart ; $i <= $iEnd ; $i++) { 
                        isset($array[$b][$i]) ? $array[$b][$i] += 1 : $array[$b][$i] = 1;
                        $a++;
                        if ($a > $contract->quantity_contract) {
                            break;
                        } 

                        if($startYear != $endYear){
                            if($i == $iEnd && $b == $endYear){
                                $b = $startYear;
                                $iStart = $start;
                                $iEnd = 4;
                                break;
                            }
                            if($i == 4){
                                $b++;
                                $iStart = 1;
                                $iEnd = $end;
                            }
                        }
                        
                    }
                }
            }
        }
        return $array;
    }
}