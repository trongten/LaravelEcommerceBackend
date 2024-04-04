<?php

namespace App\Jobs;

use App\Mail\OrderMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendOrderEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $data;
    protected $user;
    protected $pdfPath;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data,$user,$pdfPath)
    {
        $this->data = $data;
        $this->user = $user;
        $this->pdfPath  = $pdfPath;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->user->email)->send(new OrderMail($this->data,storage_path('app/' . $this->pdfPath)));
    }
}
