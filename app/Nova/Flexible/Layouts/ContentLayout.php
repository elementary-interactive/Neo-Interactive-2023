<?php

namespace App\Nova\Flexible\Layouts;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Heading;
use Laravel\Nova\Http\Requests\NovaRequest;

use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Fields\Image;
use Whitecube\NovaFlexibleContent\Flexible;
use Whitecube\NovaFlexibleContent\Layouts\Layout;

class ContentLayout extends Layout
{
    /**
     * The layout's unique identifier
     *
     * @var string
     */
    protected $name = 'content';

    /**
     * The maximum amount of this layout type that can be added
     */
    // protected $limit = ;

    /**
     * The displayed title
     *
     * @var string
     */
    protected $title = 'Tartalmi rész';

    /**
     * Get the fields displayed by the layout.
     *
     * @return array
     */
    public function fields()
    {
        return [
            Text::make('Cím', 'title')
                ->required()
                ->rules('required', 'string'),
            Flexible::make('Blokkok', 'blocks')
                ->addLayout('Blokkok', 'blocks', [
                    Text::make('Alcím', 'subtitle'),
                    Trix::make('Tartalom', 'text')
                        ->required()
                        ->rules('required')
                        ->withFiles('public'),
                    // Image::make(__('Image'), 'image')
                    //     ->store(function(Request $request) {
                    //         $request->file('image')->storeAs('contents', $request->file('image')->getFilename().'_'.$request->file('image')->getClientOriginalName(), config('nova.storage_disk'));
                    //         // dd($file);
        
                    //         return [
                    //             'image' => asset('storage/contents/'.$request->file('image')->getFilename().'_'.$request->file('image')->getClientOriginalName()),
                    //         ];
                    //     }),
                    // Select::make(__('Image alignment'), 'align')
                    //     ->options([
                    //         'left'  => __('Left'),
                    //         'right' => __('Right')
                    //     ]),
                    // Text::make(__('Image alternative text'), 'alt')
                ])
                ->button('Blokk hozzáadása'),
            // Heading::make(__('Shortcut')),
            // Boolean::make(__('Create Shortcut'), 'shortcut_need')
            //     ->help(__("If you want to put a navigation bar somewhere on the page, and if you would like to include this there, you should mark here yes.")),
            // Image::make(__('Shortcut Image'), 'shortcut_image')
            //     ->store(function(Request $request) {
            //         $request->file('shortcut_image')->storeAs('shortcuts', $request->file('shortcut_image')->getFilename().'_'.$request->file('shortcut_image')->getClientOriginalName(), config('nova.storage_disk'));
            //         // dd($file);

            //         return [
            //             'shortcut_image' => asset('storage/shortcuts/'.$request->file('shortcut_image')->getFilename().'_'.$request->file('shortcut_image')->getClientOriginalName()),
            //         ];
            //     }),
        ];
    }
}