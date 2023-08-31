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
            Markdown::make('Általános bevezető', 'empty_intro'),
            Image::make('Kép', 'empty_image'),
            Text::make('CTA Szövege', 'cta_title')
                ->help('Ha nincs állásajánlat, amit megjeleníthetnénk, akkor kirakunk egy gombot az általános jelentkezések fogadására. Itt adhatjuk meg, hogy mi legyen a gomb szövege.'),
        ];
    }
}