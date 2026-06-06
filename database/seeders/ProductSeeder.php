<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // Carpets
            ['cat' => 'Handwoven Carpets', 'name' => 'Herat Tribal Carpet 6x9 ft', 'price' => 1850.00, 'stock' => 5, 'featured' => true, 'desc' => 'Hand-knotted wool carpet from Herat with traditional tribal motifs. Each carpet takes 4-6 months to weave.'],
            ['cat' => 'Handwoven Carpets', 'name' => 'Mazar Silk-Wool Rug 4x6 ft', 'price' => 1200.00, 'stock' => 8, 'featured' => false, 'desc' => 'Silk and wool blend rug with intricate geometric patterns. Made by skilled artisans in Mazar-i-Sharif.'],
            ['cat' => 'Handwoven Carpets', 'name' => 'Kabul Heritage Runner 3x10 ft', 'price' => 890.00, 'stock' => 12, 'featured' => false, 'desc' => 'Long hallway runner with classic Afghan red and navy palette. Dense wool pile.'],
            ['cat' => 'Handwoven Carpets', 'name' => 'Antique Tribal Carpet 8x10 ft', 'price' => 3200.00, 'stock' => 2, 'featured' => true, 'desc' => 'Vintage tribal carpet aged 40+ years. Rich patina and one-of-a-kind craftsmanship.'],
            ['cat' => 'Handwoven Carpets', 'name' => 'Modern Afghan Rug 5x7 ft', 'price' => 750.00, 'stock' => 15, 'featured' => false, 'desc' => 'Contemporary design with traditional weaving technique. Subtle earth tones.'],

            // Saffron & Spices
            ['cat' => 'Saffron & Spices', 'name' => 'Herat Premium Saffron 5g', 'price' => 38.00, 'stock' => 50, 'featured' => true, 'desc' => 'Grade A+ saffron threads from Herat province. Hand-picked, sun-dried, vacuum sealed.'],
            ['cat' => 'Saffron & Spices', 'name' => 'Herat Premium Saffron 10g', 'price' => 72.00, 'stock' => 35, 'featured' => true, 'desc' => 'Double pack of premium saffron. Ideal for restaurants and bulk buyers.'],
            ['cat' => 'Saffron & Spices', 'name' => 'Afghan Cumin 250g', 'price' => 12.00, 'stock' => 80, 'featured' => false, 'desc' => 'Whole cumin seeds from Afghan highlands. Aromatic and intensely flavorful.'],
            ['cat' => 'Saffron & Spices', 'name' => 'Spice Bundle Set', 'price' => 45.00, 'stock' => 25, 'featured' => false, 'desc' => 'Cumin, coriander, cardamom, cinnamon, and saffron sample. Perfect introduction to Afghan cuisine.'],
            ['cat' => 'Saffron & Spices', 'name' => 'Wild Mountain Mint 100g', 'price' => 8.00, 'stock' => 60, 'featured' => false, 'desc' => 'Dried wild mint from the Hindu Kush mountains. Used in traditional Afghan tea and yogurt dishes.'],

            // Dried Fruits & Nuts
            ['cat' => 'Dried Fruits & Nuts', 'name' => 'Premium Pistachios 500g', 'price' => 24.00, 'stock' => 100, 'featured' => true, 'desc' => 'Naturally opened pistachios from Samangan. Lightly salted, slow-roasted to perfection.'],
            ['cat' => 'Dried Fruits & Nuts', 'name' => 'Afghan Almonds 1kg', 'price' => 19.00, 'stock' => 85, 'featured' => false, 'desc' => 'Sweet almonds from Kandahar. Excellent for snacking, baking, or making milk.'],
            ['cat' => 'Dried Fruits & Nuts', 'name' => 'White Mulberries 500g', 'price' => 16.00, 'stock' => 70, 'featured' => false, 'desc' => 'Sun-dried white mulberries — naturally sweet, no added sugar. A traditional Afghan superfood.'],
            ['cat' => 'Dried Fruits & Nuts', 'name' => 'Mixed Nuts & Dried Fruit Box', 'price' => 32.00, 'stock' => 40, 'featured' => true, 'desc' => 'Curated mix: pistachios, almonds, mulberries, raisins, apricots. Premium gift packaging.'],
            ['cat' => 'Dried Fruits & Nuts', 'name' => 'Green Raisins 1kg', 'price' => 14.00, 'stock' => 90, 'featured' => false, 'desc' => 'Famous Afghan kishmish — naturally green, tart-sweet. Hung-dried for 8 weeks.'],

            // Traditional Clothing
            ['cat' => 'Traditional Clothing', 'name' => 'Embroidered Afghan Dress', 'price' => 280.00, 'stock' => 10, 'featured' => true, 'desc' => 'Hand-embroidered traditional dress with mirror work. Made by women artisans in Kabul.'],
            ['cat' => 'Traditional Clothing', 'name' => 'Men\'s Perahan Tunban', 'price' => 95.00, 'stock' => 20, 'featured' => false, 'desc' => 'Cotton perahan tunban in cream. Comfortable for everyday wear or special occasions.'],
            ['cat' => 'Traditional Clothing', 'name' => 'Wool Pakol Hat', 'price' => 28.00, 'stock' => 30, 'featured' => false, 'desc' => 'Traditional Afghan wool hat. Warm, lightweight, and culturally iconic.'],
            ['cat' => 'Traditional Clothing', 'name' => 'Hand-stitched Chapan Coat', 'price' => 450.00, 'stock' => 6, 'featured' => true, 'desc' => 'Striped silk chapan worn over traditional clothing. A symbol of Afghan dignity and craftsmanship.'],
            ['cat' => 'Traditional Clothing', 'name' => 'Wedding Dress – Heritage', 'price' => 650.00, 'stock' => 4, 'featured' => false, 'desc' => 'Heavily embroidered wedding dress with beads and metallic thread. Made-to-order available.'],

            // Jewelry & Accessories
            ['cat' => 'Jewelry & Accessories', 'name' => 'Lapis Lazuli Necklace', 'price' => 145.00, 'stock' => 15, 'featured' => true, 'desc' => 'Genuine Badakhshan lapis lazuli with silver clasp. The same lapis sourced for ancient Egyptian pharaohs.'],
            ['cat' => 'Jewelry & Accessories', 'name' => 'Silver Tribal Bracelet', 'price' => 78.00, 'stock' => 22, 'featured' => false, 'desc' => 'Handcrafted sterling silver with traditional tribal engravings. Adjustable size.'],
            ['cat' => 'Jewelry & Accessories', 'name' => 'Lapis Earrings Set', 'price' => 62.00, 'stock' => 18, 'featured' => false, 'desc' => 'Matching lapis lazuli earrings on silver hooks. Lightweight and elegant.'],
            ['cat' => 'Jewelry & Accessories', 'name' => 'Embroidered Leather Belt', 'price' => 48.00, 'stock' => 25, 'featured' => false, 'desc' => 'Hand-tooled leather belt with colorful Afghan embroidery. Unisex design.'],
            ['cat' => 'Jewelry & Accessories', 'name' => 'Antique Silver Ring', 'price' => 95.00, 'stock' => 12, 'featured' => true, 'desc' => 'One-of-a-kind antique silver ring with turquoise stone. Sized between 6-9.'],

            // Books & Music
            ['cat' => 'Books & Music', 'name' => 'Divan of Rumi (Persian + English)', 'price' => 35.00, 'stock' => 40, 'featured' => true, 'desc' => 'Bilingual edition of Rumi\'s poetry with original Persian and modern English translation.'],
            ['cat' => 'Books & Music', 'name' => 'Afghan Literature Anthology', 'price' => 28.00, 'stock' => 35, 'featured' => false, 'desc' => 'Curated collection of modern Afghan short stories in Dari with English notes.'],
            ['cat' => 'Books & Music', 'name' => 'Traditional Music CD - Ustad Sarahang', 'price' => 18.00, 'stock' => 50, 'featured' => false, 'desc' => 'Classical Afghan ghazals by legendary Ustad Sarahang. Studio remastered.'],
            ['cat' => 'Books & Music', 'name' => 'Children\'s Persian Storybook', 'price' => 22.00, 'stock' => 45, 'featured' => false, 'desc' => 'Illustrated Persian folk tales for children. Perfect for teaching the language.'],
            ['cat' => 'Books & Music', 'name' => 'Hafez Poetry Hardcover', 'price' => 42.00, 'stock' => 28, 'featured' => true, 'desc' => 'Beautiful hardcover edition of Hafez ghazals. Premium paper and gold-foil cover.'],
        ];

        foreach ($products as $p) {
            $category = Category::where('name', $p['cat'])->first();
            if ($category) {
                Product::create([
                    'category_id' => $category->id,
                    'name' => $p['name'],
                    'slug' => Str::slug($p['name']) . '-' . uniqid(),
                    'description' => $p['desc'],
                    'price' => $p['price'],
                    'stock' => $p['stock'],
                    'is_featured' => $p['featured'],
                    'is_active' => true,
                ]);
            }
        }
    }
}