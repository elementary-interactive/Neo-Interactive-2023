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
class ContentHighlightLayout extends Layout
{
    /**
     * The layout's unique identifier
     *
     * @var string
     */
    protected $name = 'content-highlight';

    /**
     * The maximum amount of this layout type that can be added
     */
    // protected $limit = ;

    /**
     * The displayed title
     *
     * @var string
     */
    protected $title = 'Kiemelt tartalom';

    /**
     * Get the fields displayed by the layout.
     *
     * @return array
     */
    public function fields()
    {
        return [
            Text::make(__('Title'), 'title')
                ->required()
                ->rules('required', 'string'),
            Text::make(__('Subtitle'), 'subtitle'),
            Markdown::make(__('Text'), 'text')
                ->required()
                ->rules('required'),
            Image::make(__('Image'), 'image')
                ->required()
                ->creationRules('required')
                ->store(function(Request $request) {
                    $request->file('image')->storeAs('contents', $request->file('image')->getFilename().'_'.$request->file('image')->getClientOriginalName(), config('nova.storage_disk'));
                    // dd($file);

                    return [
                        'image' => asset('storage/contents/'.$request->file('image')->getFilename().'_'.$request->file('image')->getClientOriginalName()),
                    ];
                }),
            Text::make(__('Image alternative text'), 'alt'),
            Heading::make(__('Shortcut')),
            Boolean::make(__('Create Shortcut'), 'shortcut_need')
                ->help(__("If you want to put a navigation bar somewhere on the page, and if you would like to include this there, you should mark here yes.")),
            Image::make(__('Shortcut Image'), 'shortcut_image')
                ->store(function(Request $request) {
                    $request->file('shortcut_image')->storeAs('shortcuts', $request->file('shortcut_image')->getFilename().'_'.$request->file('shortcut_image')->getClientOriginalName(), config('nova.storage_disk'));
                    // dd($file);

                    return [
                        'shortcut_image' => asset('storage/shortcuts/'.$request->file('shortcut_image')->getFilename().'_'.$request->file('shortcut_image')->getClientOriginalName()),
                    ];
                }),
        ];
    }
}