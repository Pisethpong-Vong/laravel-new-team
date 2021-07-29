<?php

namespace App\Http\Controllers\Admin\Charts;

use Backpack\CRUD\app\Http\Controllers\ChartController;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;


/**
 * Class WeeklyUsersChartController
 * @package App\Http\Controllers\Admin\Charts
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class WeeklyUsersChartController extends ChartController
{
    public function setup()
    {
        $this->chart = new Chart();

        // MANDATORY. Set the labels for the dataset points
        $this->chart->labels([
            'Today',
        ]);
        $this->chart->labels(['One', 'Two', 'Three']);
        // RECOMMENDED. Set URL that the ChartJS library should call, to get its data using AJAX.
        $this->chart->load(backpack_url('charts/weekly-users'));

        // OPTIONAL
        // $this->chart->minimalist(false);
        // $this->chart->displayLegend(true);
        Widget::add([ 
            'type'       => 'chart',
            'controller' => \App\Http\Controllers\Admin\Charts\WeeklyUsersChartController::class,
        
            // OPTIONALS
        
            // 'class'   => 'card mb-2',
            // 'wrapper' => ['class'=> 'col-md-6'] ,
            // 'content' => [
                 // 'header' => 'New Users', 
                 // 'body'   => 'This chart should make it obvious how many new users have signed up in the past 7 days.<br><br>',
            // ],
        ]);
    }
    
    /**
     * Respond to AJAX calls with all the chart data points.
     *
     * @return json
     */
    // public function data()
    // {
    //     $users_created_today = \App\User::whereDate('created_at', today())->count();

    //     $this->chart->dataset('Users Created', 'bar', [
    //                 $users_created_today,
    //             ])
    //         ->color('rgba(205, 32, 31, 1)')
    //         ->backgroundColor('rgba(205, 32, 31, 0.4)');
    // }
}