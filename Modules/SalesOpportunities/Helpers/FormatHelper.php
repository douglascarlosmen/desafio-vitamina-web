<?php

namespace Modules\SalesOpportunities\Helpers;

use Carbon\Carbon;

class FormatHelper
{
    public static function daterangepickerStringToCarbonDates(string $dateragepickerString): array
    {
        $explodedDaterangepickerString = explode(' - ', $dateragepickerString);
        $carbonDates = [];

        foreach ($explodedDaterangepickerString as $index =>  $dateString) {
            $date = Carbon::createFromFormat('d/m/Y', $dateString);
            $carbonDates[] = $index > 0 ? $date->endOfDay() : $date->startOfDay();
        }

        return $carbonDates;
    }
}
