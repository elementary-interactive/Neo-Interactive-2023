<?php

namespace App\Console\Commands;

use App\Models\CaseStudy;
use Exception;
use Illuminate\Console\Command;
use Neon\Models\Statuses\BasicStatus;

class FixCaseStudies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fix-case-studies';

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
        $fuckit = CaseStudy::all();
        $doc = new \DOMDocument();

        $bar = $this->output->createProgressBar(count($fuckit));
        $bar->start();

        foreach ($fuckit as $fuck) {
            $bar->advance();
            try
            {
                $doc->loadHTML('<?xml encoding="UTF-8">'.$fuck->old_content);
                
                $need_next  = false;
                $contents   = [];
                
                foreach ($doc->getElementsByTagName('p') as $p)
                {
                    if (substr($p->nodeValue, 0, 5) == 'BRIEF' || substr($p->nodeValue, 0, 5) == 'MEGVA' || substr($p->nodeValue, 0, 5) == 'EREDM') {
                        $need_next = true;
                    }
                    if ($need_next) {
                        $contents[] = $p->nodeValue;
                    }
                };

                // if (count($contents) == 6)
                // {
                    $fuck->brief    = $contents[1];
                    $fuck->solution = $contents[3];
                    $fuck->result   = $contents[5];

                    $this->line('');
                    $this->line($fuck->title, 'info');
                    $this->line(' -'.$contents[1]);
                    $this->line(' -'.$contents[3]);
                    $this->line(' -'.$contents[5]);
                    
                    if ($this->confirm('Do you wish to continue?')) {
                        $fuck->save();
                    }
                // }
            } catch (Exception $e)
            {
                $fuck->delete();
            }
        }

        // dd($fuckit);
        $bar->finish();
    }
}
