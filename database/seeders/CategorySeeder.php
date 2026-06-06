<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Handwoven Carpets', 'description' => 'Authentic Afghan handwoven carpets crafted by master weavers from Herat and Mazar-i-Sharif.'],
            ['name' => 'Saffron & Spices', 'description' => 'Premium Afghan saffron and spices, sourced from Herat — the world\'s finest saffron region.'],
            ['name' => 'Dried Fruits & Nuts', 'description' => 'Pistachios, almonds, raisins, and dried mulberries from Afghan orchards.'],
            ['name' => 'Traditional Clothing', 'description' => 'Perahan tunban, chapans, and embroidered dresses with authentic Afghan craftsmanship.'],
            ['name' => 'Jewelry & Accessories', 'description' => 'Lapis lazuli, silver, and handcrafted jewelry from Afghan artisans.'],
            ['name' => 'Books & Music', 'description' => 'Persian poetry, Afghan literature, and traditional music from celebrated artists.'],
        ];

        foreach ($categories as $cat) {
            Category::create([
                'name' => $cat['name'],
                'slug' => Str::slug($cat['name']),
                'description' => $cat['description'],
                'is_active' => true,
            ]);
        }
    }
}