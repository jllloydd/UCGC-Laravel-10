<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Appointment;

class CounselModeAnalytics
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\DonutChart
    {
        return $this->chart->donutChart()
            ->setTitle('Most Frequently Selected Counsel Modes')
            ->addData([
                Appointment::where('mode', 'Video Call')->count(), 
                Appointment::where('mode', 'Chat')->count(), 
                Appointment::where('mode', 'Face-to-Face')->count()
                ])
            ->setLabels(['Video Call', 'Chat', 'Face - to - Face'])
            ->setFontFamily('Nexa')
            ->setColors(['#8cd3ec', '#6474f3', '#344ac0']);
    }
}
