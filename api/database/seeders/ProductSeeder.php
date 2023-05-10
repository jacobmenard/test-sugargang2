<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'title' => 'Takis Blue Heat 113,4g LIMITED',
            'price' => 400.00,
            'quantity' => 20,
            'ingredients' => 'Corn Masa Meal, Vegetable Oil (Palm and/or Soybean and/or Canola and/or Rice Bran Oil), Flavors Maltodextrin, Citric Acid, Sugar, Potassium Chloride, Salt, Monosodium Glutamate, Hydrolyzed Soybean Protein, Natural and Artificial Flavors, Hydrolyzed Yeast, Soybean Oil, Onion Powder, Blue 1, Sodium Bicarbonate, Chili Pepper (Chili), Disodium Inosinate, Disodium Guanylate, Tbhq (Antioxidant).',
            'sku' => 'PROD29381'
        ]);

        Product::create([
            'title' => 'Calypso Ocean Blue Lemonade 473ml',
            'price' => 458.00,
            'quantity' => 20,
            'ingredients' => 'Filtered water, sugar, lemon juice from concentrate, citric acid, lemon fruit pulp, natural flavor, modified food starch, beta-carotene, EDTA to protect color.',
            'sku' => 'PROD29382'
        ]);
    }
}
