<?php

namespace App\Nova\Flexible\Layouts;

use Laravel\Nova\Fields\Heading;
use Laravel\Nova\Fields\Text;
use Whitecube\NovaFlexibleContent\Layouts\Layout;

class NewsLayout extends Layout
{
    /**
     * The layout's unique identifier
     *
     * @var string
     */
    protected $name = 'news';

    /**
     * The maximum amount of this layout type that can be added
     */
    protected $limit = 1;

    /**
     * The displayed title
     *
     * @var string
     */
    protected $title = 'Friss hírek';

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
            Heading::make('Dátum mező:'),
            Text::make('Label', 'date_label')
                ->required(),
            Heading::make('Partner mező:'),
            Text::make('Label', 'partner_label')
                ->required(),
            Heading::make('Címke mező:'),
            Text::make('Label', 'tag_label')
                ->required(),
        ];
    }
}