<?php

namespace App\Nova\Flexible\Layouts;

use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Heading;
use Whitecube\NovaFlexibleContent\Layouts\Layout;

class CoursesLayout extends Layout
{

    /**
     * The layout's unique identifier
     *
     * @var string
     */
    protected $name = 'courses';

    /**
     * The displayed title
     *
     * @var string
     */
    protected $title = 'Képzések';

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
            Heading::make('Üres regisztráció'),
            Text::make('Cím', 'empty_title'),
            Image::make('Kép', 'empty_image'),
            Text::make('CTA Szövege', 'cta_empty_title')
                ->help('Ha nincs aktuális képzés, amit megjeleníthetnénk, akkor kirakunk egy gombot az általános jelentkezések fogadására. Itt adhatjuk meg, hogy mi legyen a gomb szövege.'),
            Heading::make('Regisztráció'),
            Text::make('Élő közvetítés szövege', 'stream_title')
                ->help('A ##datum## szöveg a szövegben a stream kezdetének a dátumára fordul le.'),
            Text::make('Regisztráció gomb', 'cta_title')
                ->help('Esemény regisztráció gomb felirata'),
            Text::make('Esemény megtekintése gomb', 'cta_view')
                ->help('Esemény regisztráció gomb felirata'),

        ];
    }
}
