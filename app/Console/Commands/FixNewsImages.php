<?php

namespace App\Console\Commands;

use App\Models\News;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class FixNewsImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fix-news-images';

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
        $images = DB::table("news_images")->get();

        $bar = $this->output->createProgressBar(count($images));
        $bar->start();

        foreach ($images as $image)
        {
            $bar->advance();
            if ($image->image)
            {
                try {
                    list(, $image_path) = explode('::', $image->image);

                    $news = News::where('slug', $image->slug)->first();
                    $news->addMediaFromUrl(Storage::url('old/'.$image_path))
                        ->toMediaCollection(News::MEDIA_COLLECTION);
                    $news->image = $image_path;
                    $news->save();
                } catch (\Exception $e) {
                }
            }
        }
        $bar->finish();
        $this->info('News images converted!');
    }
}
