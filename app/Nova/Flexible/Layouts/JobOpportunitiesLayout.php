<?php

namespace App\Nova\Flexible\Layouts;

use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Whitecube\NovaFlexibleContent\Layouts\Layout;

class JobOpportunitiesLayout extends Layout
{

    /**
     * The layout's unique identifier
     *
     * @var string
     */
    protected $name = 'job_opportunities';

    /**
     * The displayed title
     *
     * @var string
     */
    protected $title = 'Állásajánlatok';

    /**
     * Get the fields displayed by the layout.
     *
     * @return array
     */
    public function fields()
    {
        return [

            Text::make('Cím', 'title'),
            Markdown::make('Általános bevezető', 'intro'),
            Text::make('CTA Szövege', 'cta_title')
                ->help('Ha nincs állásajánlat, amit megjeleníthetnénk, akkor kirakunk egy gombot az általános jelentkezések fogadására. Itt adhatjuk meg, hogy mi legyen a gomb szövege.'),
        ];
    }
}