<?php

namespace App\Jobs;

use App\Models\AdImage;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;

class GoogleVisionLabelImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $ad_image_id;

    public function __construct( $ad_image_id)
    {
        $this->ad_image_id =  $ad_image_id;
    }


    public function handle()
    {
        $i = AdImage::find($this->ad_image_id);
        if(!$i) {return;}

        $image = file_get_contents(storage_path('/app/' . $i->file));

        // google credenziali

        putenv('GOOGLE_APPLICATION_CREDENTIALS=' . base_path('google_credential.json'));

        $imageAnnotator = new ImageAnnotatorClient();
        $response = $imageAnnotator->labelDetection($image);
        $labels = $response->getLabelAnnotations();

        if($labels) {
            $result = [];

            foreach ($labels as $label) {
                $result[] = $label->getDescription();
            }
            $i->labels = $result;

            $i->save();

        }
            $imageAnnotator->close();
    }
}
