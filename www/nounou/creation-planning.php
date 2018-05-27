<?php
/**
 * Created by PhpStorm.
 * User: theobour
 * Date: 16/05/2018
 * Time: 20:40
 */
function build_html_calendar($year, $month, $events = null) {

    // CSS classes
    $css_cal = 'calendar';
    $css_cal_row = 'calendar-row';
    $css_cal_day_head = 'calendar-day-head';
    $css_cal_day = 'calendar-day';
    $css_cal_day_number = 'day-number';
    $css_cal_day_blank = 'calendar-day-np';
    $css_cal_day_event = 'calendar-day-event';
    $css_cal_event = 'calendar-event';

    // Table headings
    $headings = ['M', 'T', 'W', 'T', 'F', 'S', 'S'];

    // Start: draw table
    $calendar =
        "<table cellpadding='0' cellspacing='0' class='{$css_cal}'>" .
        "<tr class='{$css_cal_row}'>" .
        "<td class='{$css_cal_day_head}'>" .
        implode("</td><td class='{$css_cal_day_head}'>", $headings) .
        "</td>" .
        "</tr>";

    // Days and weeks
    $running_day = date('N', mktime(0, 0, 0, $month, 1, $year));
    $days_in_month = date('t', mktime(0, 0, 0, $month, 1, $year));

    // Row for week one
    $calendar .= "<tr class='{$css_cal_row}'>";

    // Print "blank" days until the first of the current week
    for ($x = 1; $x < $running_day; $x++) {
        $calendar .= "<td class='{$css_cal_day_blank}'> </td>";
    }

    // Keep going with days...
    for ($day = 1; $day <= $days_in_month; $day++) {

        // Check if there is an event today
        $cur_date = date('Y-m-d', mktime(0, 0, 0, $month, $day, $year));
        $draw_event = false;
        if (isset($events) && isset($events[$cur_date])) {
            $draw_event = true;
        }

        // Day cell
        $calendar .= $draw_event ?
            "<td class='{$css_cal_day} {$css_cal_day_event}'>" :
            "<td class='{$css_cal_day}'>";

        // Add the day number
        $calendar .= "<div class='{$css_cal_day_number}'>" . $day . "</div>";

        // Insert an event for this day
        if ($draw_event) {
            $calendar .=
                "<div class='{$css_cal_event}'>" .
                "<a href='{$events[$cur_date]['href']}'>" .
                $events[$cur_date]['text'] .
                "</a>" .
                "</div>";
        }

        // Close day cell
        $calendar .= "</td>";

        // New row
        if ($running_day == 7) {
            $calendar .= "</tr>";
            if (($day + 1) <= $days_in_month) {
                $calendar .= "<tr class='{$css_cal_row}'>";
            }
            $running_day = 1;
        }

        // Increment the running day
        else {
            $running_day++;
        }

    } // for $day

    // Finish the rest of the days in the week
    if ($running_day != 1) {
        for ($x = $running_day; $x <= 7; $x++) {
            $calendar .= "<td class='{$css_cal_day_blank}'> </td>";
        }
    }

    // Final row
    $calendar .= "</tr>";

    // End the table
    $calendar .= '</table>';

    // All done, return result
    return $calendar;
}

$events = [
    '2018-05-16' => [
        'text' => "An event for the 5 july 2015",
        'href' => "http://example.com/link/to/event"
    ],
    '2018-05-23' => [
        'text' => "An event for the 23 july 2015",
        'href' => "/path/to/event"
    ],
];
echo "<h2>July 2015</h2>";
echo build_html_calendar($_GET['year'], $_GET['month'], $events);


$test = strtotime("Monday");
echo date('m/d/Y', $test) . '<br>';
echo strtotime("10 September 2000"), "<br>\n";
echo strtotime("+1 day"), "<br>\n";
echo strtotime("+1 week"), "<br>\n";
echo strtotime("+1 week 2 days 4 hours 2 seconds"), "<br>\n";
echo strtotime("next Thursday"), "<br>\n";
echo strtotime("2018-05"), "<br>\n";
?>