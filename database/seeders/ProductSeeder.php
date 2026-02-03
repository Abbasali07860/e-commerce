<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $uploadPath = public_path('products');
        if (!File::exists($uploadPath)) {
            File::makeDirectory($uploadPath, 0755, true);
        }
        for ($i = 1; $i <= 50; $i++) {
            $title = 'Product ' . $i;
            $price = rand(100, 500);
            $imageName = 'product_' . $i . '.jpg';
            $imagePath = 'products/' . $imageName;
            $imageUrl = 'https://picsum.photos/300/300?random=' . $i;

            try {
                file_put_contents(public_path($imagePath), file_get_contents($imageUrl));
            } catch (\Exception $e) {
                $imagePath = 'products/default.jpg';
            }
            Product::create([
                'title' => $title,
                'price' => $price,
                'image' => $imagePath,
            ]);
        }
    }
}
