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

class CourseFormLayout extends Layout
{

    /**
     * The layout's unique identifier
     *
     * @var string
     */
    protected $name = 'course_form';

    /**
     * The displayed title
     *
     * @var string
     */
    protected $title = 'Kurzus jelentkezés úrlap';

    /**
     * Get the fields displayed by the layout.
     *
     * @return array
     */
    public function fields()
    {
        return [
            Text::make('Cím', 'title')
                ->help('Az űrlap címe'),
            Heading::make('Név mező:'),
            Text::make('Label', 'name_label')
                ->required(),
            Text::make('Placeholder', 'name_placeholder'),
            Heading::make('Telefonszám mező:'),
            Text::make('Label', 'phone_label')
                ->required(),
            Text::make('Placeholder', 'phone_placeholder'),
            Heading::make('Email mező:'),
            Text::make('Label', 'email_label')
                ->required(),
            Text::make('Placeholder', 'email_placeholder'),
            Heading::make('CV feltöltés:'),
            Text::make('Label', 'file_label')
                ->required(),
            Heading::make('Privacy Policy'),
            Text::make('Label', 'privacy_label')
                ->help("Tartalmazhat HTML elemeket is. A @@@@@ (5*@) karaktersorozatot a privacy oldal linkjére cseréli a rendszer.")
                ->required(),
            Heading::make('Beküldés'),
            Text::make('Label', 'submit_label')
                ->required(),
        ];
    }
}