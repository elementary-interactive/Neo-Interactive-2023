<?php

namespace App\Console\Commands;

use App\Models\CaseStudy;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class FixCaseStudyImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fix-case-study-images';

    protected $image_fields = [
        
        // 'videomp4',
        // 'videoogv',
        // 'videoimage',
        'pic1',
        'pic2',
        'pic3',
        'pic4',
        'pic5',
        'image',
        'image2',
    ];

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $images = DB::table("case_studies_images")->get();

        $bar = $this->output->createProgressBar(count($images));
        $bar->start();

        foreach ($images as $image)
        {
            $bar->advance();
            if ($image->image)
            {
                try {
                    $cs = CaseStudy::where('slug', $image->slug)->first();
                    if ($cs) {
                        $this->line(' CHECK: '.$cs->title);
                        foreach ($this->image_fields as $field)
                        {
                            list($folder, $image_path) = explode('::', $image->$field);

                            $this->line(' + found: '.$image_path);

                            $cs->addMediaFromUrl(Storage::url('old/'.$folder.'/'.$image_path))
                                ->toMediaCollection(CaseStudy::MEDIA_COLLECTION);
                        }
                    }
                } catch (\Exception $e) {
                }
            }
        }
        $bar->finish();
        $this->info('Case Study images converted!');
    }
}
