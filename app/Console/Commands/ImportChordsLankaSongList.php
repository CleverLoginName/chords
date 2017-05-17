<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ImportChordsLankaSongList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:chords-lanka-list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $filesInFolder = File::files(public_path('chords-lanka-html'));
        $maches= [];
        $songeIDs= [];
        $numberArray= [];
        for($nn=0;$nn <2277;$nn++){
            $numberArray[] = $nn;
        }
        foreach($filesInFolder as $file_path){
            $contents = File::get($file_path);
            $j = explode('<div id="search_results_display">',$contents);
            $k = explode('</div>',$j[1]);
            $songList = $k[0];
            $l = explode('song_id=',$songList);
            foreach($l as $m){
                $m = explode("'>",$l[1]);
                $songeIDs[] = intval($m[0]);
            }


          //  dd($contents->getContents());
        }
        $niq = array_unique($songeIDs);
        sort($niq);
        dd($niq);
        dd(array_diff($numberArray,$songeIDs));
    }
}
