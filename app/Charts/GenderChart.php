<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Appointment;

class GenderChart
{
    protected $barchart;

    public function __construct(LarapexChart $barchart)
    {
        $this->barchart = $barchart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        return $this->barchart->pieChart()
            ->setTitle('Most Frequently Selected Counselor Gender')
            ->addData([
                Appointment::where('gender', 'Male')->count(),
                Appointment::where('gender', 'Female')->count(), 
                Appointment::where('gender', 'Any')->count()
                ])
            ->setLabels(['Male', 'Female', 'Any']);
    }
}
