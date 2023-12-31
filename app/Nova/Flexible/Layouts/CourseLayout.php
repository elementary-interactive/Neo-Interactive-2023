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

class CourseLayout extends Layout
{

    /**
     * The layout's unique identifier
     *
     * @var string
     */
    protected $name = 'course';

    /**
     * The displayed title
     *
     * @var string
     */
    protected $title = 'Kurzus';

    /**
     * Get the fields displayed by the layout.
     *
     * @return array
     */
    public function fields()
    {
        return [
            Heading::make('Oldal elemei:'),
            Text::make('Az oldal címe', 'main_title'),
            Text::make('"További kurzusok" cím', 'more_title'),
            Text::make('"További kurzusok" megtekintés gomb', 'cta_view'),
            Heading::make('Általános jelentkezés tartalmi elemei:'),
            Text::make('Cím', 'title'),
            Trix::make('Általános leírás', 'description'),
        ];
    }
}