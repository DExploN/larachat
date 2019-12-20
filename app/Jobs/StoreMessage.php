<?php

namespace App\Jobs;

use App\Message;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StoreMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $text;
    private $user_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($text, User $user)
    {
        //
        $this->text = $text;
        $this->user_id = $user->id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Message::create(['text' => $this->text, 'user_id' => $this->user_id]);
    }
}
