<?php

namespace App\View\Components;

use Roots\Acorn\View\Component;
use DateTime;

class WidgetArchive extends Component
{
    /**
     * The search title.
     *
     * @var string
     */
    public $title;

    public $yearMonth;

    /**
     * Create the component instance.
     *
     * @param  string  $title
     * @return void
     */
    public function __construct($title)
    {
        $this->title = $title;
        $this->yearMonth = $this->getArchiveByYearAndMonth();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return $this->view('components.widget-archive');
    }

    /**
     * List archives by year, then month
     * 
     * @return string
     */
    public function getArchiveByYearAndMonth() {
        global $wpdb;
        $html = '';
        $years = $wpdb->get_col("SELECT DISTINCT YEAR(post_date) FROM $wpdb->posts WHERE post_type IN ('post', 'program') AND post_status = 'publish' ORDER BY post_date DESC");
        if($years){
            $html .= '<ul>';
            foreach($years as $year){
                $html.='<li class="archive-year"><a href="'.get_year_link($year).'">'.$year.'</a>';
                $html.='<ul>';
                $months = $wpdb->get_col($wpdb->prepare("SELECT DISTINCT MONTH(post_date) FROM $wpdb->posts WHERE post_type IN ('post', 'program') AND post_status='publish' AND YEAR(post_date) = %d ORDER BY post_date ASC",$year));
                foreach($months as $month){
                    $dateObj   = DateTime::createFromFormat('!m', $month);
                    $monthName = $dateObj->format('F'); 
                    $html.='<li class="archive-month"><a href="'.get_month_link($year,$month).'">'.$monthName.'</a></li>';
                }
                $html.='</ul>';
                $html.='</li>';
            }
            $html.='</ul>';
        }
        return $html;
    }
}