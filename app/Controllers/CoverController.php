<?php

namespace App\Controllers;



class CoverController
{

    public function algo($orders)
    {

        $cover = $this->sortByYear($orders);
        foreach ($cover as $key => $year) {
            $cover[$key]['orders'] = $this->sortByProvider($year['orders']);
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
                    'orders' => [$order]
                ];
            } else {
                $years[$year]['orders'][] = $order;
            }
        }
        return $years;
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
                    'orders' => [$order]
                ];
            } else {
                $providers[$provider]['orders'][] = $order;
            }
        }
        return $providers;
    }

    public function sortByTrimestre($orders)
    {
        $trimestres = [];
        $total = 0;
        foreach ($orders as $order) {
            $trimestre = $this->getTrimestre($order->date_order2);
            if (!isset($trimestres[$trimestre])) {
                $total += $order->quantity_order;
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
    
}