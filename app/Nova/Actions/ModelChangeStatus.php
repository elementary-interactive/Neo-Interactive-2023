<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;
use Neon\Models\Statuses\BasicStatus;

class ModelChangeStatus extends Action
{
    use InteractsWithQueue, Queueable;
    
    /**
     * The displayable name of the action.
     *
     * @var string
     */
    public $name = 'Státusz változtatás';

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        foreach ($models as $model) {
            $model->status = $fields->status;
            $model->save();
        }
    }

    /**
     * Get the fields available on the action.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Select::make('Státusz', 'status')
                ->options([
                    BasicStatus::Active->value => 'Aktív',
                    BasicStatus::Inactive->value => 'Inktív'
                ])
        ];
    }
}
