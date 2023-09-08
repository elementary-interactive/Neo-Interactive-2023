<?php

namespace App\Nova\Flexible\Layouts;

use Laravel\Nova\Fields\Heading;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Trix;
use Whitecube\NovaFlexibleContent\Layouts\Layout;

class TestimonyLayout extends Layout
{

    /**
     * The layout's unique identifier
     *
     * @var string
     */
    protected $name = 'testimony';

    /**
     * The displayed title
     *
     * @var string
     */
    protected $title = 'Bemutatkozó';

    /**
     * Get the fields displayed by the layout.
     *
     * @return array
     */
    public function fields()
    {
        return [
            Heading::make('Weboldal blokk'),
            Text::make('Cím', 'main_title'),
            Text::make('Alcím', 'main_subtitle'),
            Text::make('1. gomb szövege', 'main_cta1_title'),
            Text::make('2. gomb szövege', 'main_cta2_title'),
            Text::make('Showreel gomb szövege', 'main_cta-showreel_title'),
            Heading::make('Belső popup'),
            Text::make('Vissza gomb szövege', 'popup_cta-back_title'),
            Text::make('Cím', 'popup_title'),
            Text::make('Alcím', 'popup_subtitle'),
            Trix::make('Tartalom', 'popup_content'),
        ];
    }
}