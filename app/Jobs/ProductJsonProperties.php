<?php

namespace App\Jobs;

use Domain\Product\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProductJsonProperties implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Product $product;

    /**
     * Create a new job instance.
     */
    public function __construct(Product $product)
    {
      $this->product = $product;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        $properties = $this->product->properties->mapWithKeys(fn($property)=>[$property->title => $property->pivot->value]);
        $this->product->updateQuietly(['json_properties'=>$properties]);
    }

    public function uniqueId()
    {
        return $this->product->getKey();
    }
}
