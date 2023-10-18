<?php

namespace App\Jobs;

use App\Models\Row;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use Shuchkin\SimpleXLSX;

class ParseRowsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private int $startLine;
    private string $path;
    private int $line;

    /**
     * Create a new job instance.
     */
    public function __construct($path)
    {
        $this->path = $path;
        $this->startLine = Redis::get($this->path);
        $this->line = 0;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if ( $xlsx = SimpleXLSX::parse( 'storage/app/' . $this->path ) ) {
            foreach ( $xlsx->readRows() as $r) {
                if ($this->line < $this->startLine) {
                    $this->line++;
                    continue;
                }

                $this->line++;

                Row::create([
                    'row_id' => $r[0],
                    'name' => $r[1],
                    'date' => $r[2],
                ]);

                if ($this->line >= $this->startLine + 1000) {
                    Redis::set($this->path, $this->line);
                    ParseRowsJob::dispatch($this->path)->onQueue('high');

                    return;
                }

            }

        } else {
            echo SimpleXLSX::parseError();
        }

        Redis::set($this->path, $this->line);
    }

}
