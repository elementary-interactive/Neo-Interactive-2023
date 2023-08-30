<?php

namespace App\Nova\Flexible\Layouts;

use GuzzleHttp\Psr7\Header;
use Laravel\Nova\Fields\Heading;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Trix;
use Whitecube\NovaFlexibleContent\Layouts\Layout;

class JobOpportunityLayout extends Layout
{

    /**
     * The layout's unique identifier
     *
     * @var string
     */
    protected $name = 'job_opportunity';

    /**
     * The displayed title
     *
     * @var string
     */
    protected $title = 'Állásajánlat';

    /**
     * Get the fields displayed by the layout.
     *
     * @return array
     */
    public function fields()
    {
        return [
            Heading::make('Általános jelentkezés tartalmi elemei:'),
            Text::make('Cím', 'title'),
            Trix::make('Általános leírás', 'description'),
        ];
    }
}