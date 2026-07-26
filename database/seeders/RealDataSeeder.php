<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Database\Seeder;

class RealDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Coffee
        $catCoffee = Category::create([
            'name' => 'Coffee',
            'image' => 'image/coffee/coffee cate.jpg'
        ]);

        $subHotCoffee = Subcategory::create(['category_id' => $catCoffee->id, 'name' => 'Hot Coffee', 'image' => 'image/coffee/hot coffee category .jpg']);
        $subIcedCoffee = Subcategory::create(['category_id' => $catCoffee->id, 'name' => 'Iced Coffee', 'image' => 'image/coffee/iced coffee category .jpg']);

        Product::create(['subcategory_id' => $subHotCoffee->id, 'name' => 'Espresso', 'price' => 20, 'image' => 'image/coffee/esspresso.jpg', 'description' => 'Rich and bold espresso.', 'stock' => 50, 'is_featured' => true]);
        Product::create(['subcategory_id' => $subHotCoffee->id, 'name' => 'Hot Americano', 'price' => 25, 'image' => 'image/coffee/hot amrecano.jpg', 'description' => 'Classic hot americano.', 'stock' => 50, 'is_featured' => false]);
        Product::create(['subcategory_id' => $subHotCoffee->id, 'name' => 'Hot Dark Mocha', 'price' => 35, 'image' => 'image/coffee/hot dark mocha.jpg', 'description' => 'Dark chocolate mocha.', 'stock' => 50, 'is_featured' => false]);
        Product::create(['subcategory_id' => $subHotCoffee->id, 'name' => 'Hot Latte', 'price' => 30, 'image' => 'image/coffee/hot latte.jpg', 'description' => 'Smooth hot latte.', 'stock' => 50, 'is_featured' => true]);

        Product::create(['subcategory_id' => $subIcedCoffee->id, 'name' => 'Iced Americano', 'price' => 25, 'image' => 'image/coffee/iced amrecano.jpg', 'description' => 'Refreshing iced americano.', 'stock' => 50, 'is_featured' => false]);
        Product::create(['subcategory_id' => $subIcedCoffee->id, 'name' => 'Iced Cold Brew', 'price' => 40, 'image' => 'image/coffee/iced cold brew.jpg', 'description' => 'Slow-steeped cold brew.', 'stock' => 50, 'is_featured' => true]);
        Product::create(['subcategory_id' => $subIcedCoffee->id, 'name' => 'Iced Dark Mocha', 'price' => 40, 'image' => 'image/coffee/iced dark mocha.jpg', 'description' => 'Iced dark chocolate mocha.', 'stock' => 50, 'is_featured' => false]);
        Product::create(['subcategory_id' => $subIcedCoffee->id, 'name' => 'Iced Latte', 'price' => 35, 'image' => 'image/coffee/iced latte.jpg', 'description' => 'Creamy iced latte.', 'stock' => 50, 'is_featured' => false]);

        // 2. Fresh Juice
        $catJuice = Category::create([
            'name' => 'Fresh Juice',
            'image' => 'image/fresh juice/fresh juice.jpg'
        ]);

        $subSingleJuice = Subcategory::create(['category_id' => $catJuice->id, 'name' => 'Single Fruit Juice', 'image' => 'image/fresh juice/fresh juice.jpg']);
        $subBlendedJuice = Subcategory::create(['category_id' => $catJuice->id, 'name' => 'Blended Juice', 'image' => 'image/fresh juice/Beet-Apple Juice.jpg']);

        Product::create(['subcategory_id' => $subSingleJuice->id, 'name' => 'Mango Juice', 'price' => 30, 'image' => 'image/fresh juice/mango juice.jpg', 'description' => 'Fresh mango juice.', 'stock' => 50, 'is_featured' => true]);
        Product::create(['subcategory_id' => $subSingleJuice->id, 'name' => 'Orange Juice', 'price' => 25, 'image' => 'image/fresh juice/orange juice.jpg', 'description' => 'Freshly squeezed orange juice.', 'stock' => 50, 'is_featured' => false]);
        Product::create(['subcategory_id' => $subSingleJuice->id, 'name' => 'Pineapple Juice', 'price' => 35, 'image' => 'image/fresh juice/pinnaple juice.jpg', 'description' => 'Tropical pineapple juice.', 'stock' => 50, 'is_featured' => false]);
        Product::create(['subcategory_id' => $subSingleJuice->id, 'name' => 'Watermelon Juice', 'price' => 25, 'image' => 'image/fresh juice/watermelon juice.jpg', 'description' => 'Refreshing watermelon juice.', 'stock' => 50, 'is_featured' => true]);

        Product::create(['subcategory_id' => $subBlendedJuice->id, 'name' => 'Beet-Apple Juice', 'price' => 40, 'image' => 'image/fresh juice/Beet-Apple Juice.jpg', 'description' => 'Healthy beet and apple blend.', 'stock' => 50, 'is_featured' => false]);
        Product::create(['subcategory_id' => $subBlendedJuice->id, 'name' => 'Ginger-Lemon Juice', 'price' => 35, 'image' => 'image/fresh juice/Ginger-Lemon Juice.jpg', 'description' => 'Zesty ginger and lemon.', 'stock' => 50, 'is_featured' => false]);
        Product::create(['subcategory_id' => $subBlendedJuice->id, 'name' => 'Orange-Carrot Juice', 'price' => 35, 'image' => 'image/fresh juice/Orange-Carrot Juice.jpg', 'description' => 'Nutritious orange and carrot blend.', 'stock' => 50, 'is_featured' => true]);

        // 3. Matcha
        $catMatcha = Category::create([
            'name' => 'Matcha',
            'image' => 'image/matcha/matcha cate.jpg'
        ]);

        $subHotMatcha = Subcategory::create(['category_id' => $catMatcha->id, 'name' => 'Hot Matcha', 'image' => 'image/matcha/hot matcha.jpg']);
        $subIcedMatcha = Subcategory::create(['category_id' => $catMatcha->id, 'name' => 'Iced Matcha', 'image' => 'image/matcha/iced matcha .jpg']);

        Product::create(['subcategory_id' => $subHotMatcha->id, 'name' => 'Hot Matcha', 'price' => 45, 'image' => 'image/matcha/hot matcha.jpg', 'description' => 'Traditional hot matcha.', 'stock' => 50, 'is_featured' => false]);
        Product::create(['subcategory_id' => $subHotMatcha->id, 'name' => 'Hot Matcha Latte', 'price' => 50, 'image' => 'image/matcha/hot matcha latte.jpg', 'description' => 'Creamy hot matcha latte.', 'stock' => 50, 'is_featured' => true]);

        Product::create(['subcategory_id' => $subIcedMatcha->id, 'name' => 'Blueberry Matcha', 'price' => 55, 'image' => 'image/matcha/blueberry matcha.jpg', 'description' => 'Matcha with blueberry flavor.', 'stock' => 50, 'is_featured' => false]);
        Product::create(['subcategory_id' => $subIcedMatcha->id, 'name' => 'Mango Matcha', 'price' => 55, 'image' => 'image/matcha/mango.jpg', 'description' => 'Tropical mango matcha.', 'stock' => 50, 'is_featured' => true]);
        Product::create(['subcategory_id' => $subIcedMatcha->id, 'name' => 'Matcha Coconut', 'price' => 60, 'image' => 'image/matcha/matcha coconut.jpg', 'description' => 'Matcha blended with coconut milk.', 'stock' => 50, 'is_featured' => false]);
        Product::create(['subcategory_id' => $subIcedMatcha->id, 'name' => 'Pink Matcha', 'price' => 55, 'image' => 'image/matcha/pink matcha.jpg', 'description' => 'Special pink matcha blend.', 'stock' => 50, 'is_featured' => true]);
        Product::create(['subcategory_id' => $subIcedMatcha->id, 'name' => 'Rose Matcha', 'price' => 60, 'image' => 'image/matcha/rose.jpg', 'description' => 'Delicate rose-flavored matcha.', 'stock' => 50, 'is_featured' => false]);

        // 4. Refreshers
        $catRefreshers = Category::create([
            'name' => 'Refreshers',
            'image' => 'image/refreshers/refreshers.jpg'
        ]);

        $subMojito = Subcategory::create(['category_id' => $catRefreshers->id, 'name' => 'Mojito', 'image' => 'image/refreshers/mojito.jpg']);
        $subIcedTea = Subcategory::create(['category_id' => $catRefreshers->id, 'name' => 'Iced Tea', 'image' => 'image/refreshers/peach iced tea.jpg']);

        Product::create(['subcategory_id' => $subMojito->id, 'name' => 'Classic Mojito', 'price' => 35, 'image' => 'image/refreshers/mojito.jpg', 'description' => 'Classic mint and lime mojito.', 'stock' => 50, 'is_featured' => false]);
        Product::create(['subcategory_id' => $subMojito->id, 'name' => 'Pina Colada Mojito', 'price' => 45, 'image' => 'image/refreshers/pina colada mojito.jpg', 'description' => 'Tropical pina colada mojito.', 'stock' => 50, 'is_featured' => true]);
        Product::create(['subcategory_id' => $subMojito->id, 'name' => 'Strawberry Mojito', 'price' => 40, 'image' => 'image/refreshers/strawberry mojito.jpg', 'description' => 'Sweet strawberry mojito.', 'stock' => 50, 'is_featured' => false]);
        Product::create(['subcategory_id' => $subMojito->id, 'name' => 'Watermelon Mojito', 'price' => 40, 'image' => 'image/refreshers/watermelon mojito.jpg', 'description' => 'Refreshing watermelon mojito.', 'stock' => 50, 'is_featured' => true]);

        Product::create(['subcategory_id' => $subIcedTea->id, 'name' => 'Blueberry Iced Tea', 'price' => 35, 'image' => 'image/refreshers/blue berry iced tea.jpg', 'description' => 'Iced tea infused with blueberry.', 'stock' => 50, 'is_featured' => false]);
        Product::create(['subcategory_id' => $subIcedTea->id, 'name' => 'Lemon Iced Tea', 'price' => 30, 'image' => 'image/refreshers/lemon ioced tea.jpg', 'description' => 'Classic lemon iced tea.', 'stock' => 50, 'is_featured' => false]);
        Product::create(['subcategory_id' => $subIcedTea->id, 'name' => 'Peach Iced Tea', 'price' => 35, 'image' => 'image/refreshers/peach iced tea.jpg', 'description' => 'Sweet peach iced tea.', 'stock' => 50, 'is_featured' => true]);

        // 5. Smoothies
        $catSmoothies = Category::create([
            'name' => 'Smoothies',
            'image' => 'image/smoothies/smoothies.jpg'
        ]);

        $subFruitSmoothie = Subcategory::create(['category_id' => $catSmoothies->id, 'name' => 'Fruit Smoothies', 'image' => 'image/smoothies/berry.jpg']);
        $subDessertSmoothie = Subcategory::create(['category_id' => $catSmoothies->id, 'name' => 'Dessert Smoothies', 'image' => 'image/smoothies/nutella smoothie.jpg']);

        Product::create(['subcategory_id' => $subFruitSmoothie->id, 'name' => 'Mixed Berry Smoothie', 'price' => 45, 'image' => 'image/smoothies/berry.jpg', 'description' => 'Blend of wild berries.', 'stock' => 50, 'is_featured' => true]);
        Product::create(['subcategory_id' => $subFruitSmoothie->id, 'name' => 'Mango Smoothie', 'price' => 40, 'image' => 'image/smoothies/mango smoothie.jpg', 'description' => 'Creamy mango smoothie.', 'stock' => 50, 'is_featured' => false]);
        Product::create(['subcategory_id' => $subFruitSmoothie->id, 'name' => 'Strawberry Smoothie', 'price' => 40, 'image' => 'image/smoothies/straw smoothie.jpg', 'description' => 'Fresh strawberry smoothie.', 'stock' => 50, 'is_featured' => false]);
        Product::create(['subcategory_id' => $subFruitSmoothie->id, 'name' => 'Tropical Blend', 'price' => 45, 'image' => 'image/smoothies/pexels-alejandro-aznar-155337093-28525199.jpg', 'description' => 'Special tropical fruit blend.', 'stock' => 50, 'is_featured' => true]);

        Product::create(['subcategory_id' => $subDessertSmoothie->id, 'name' => 'Nutella Smoothie', 'price' => 50, 'image' => 'image/smoothies/nutella smoothie.jpg', 'description' => 'Indulgent Nutella smoothie.', 'stock' => 50, 'is_featured' => true]);

        // 6. Shop
        $catShop = Category::create([
            'name' => 'Shop',
            'image' => 'image/shop/shop.jpg'
        ]);

        $subEquipment = Subcategory::create(['category_id' => $catShop->id, 'name' => 'Mugs & Cups', 'image' => 'image/shop/Ceramic Mug.jpg']);
        $subPowders = Subcategory::create(['category_id' => $catShop->id, 'name' => 'Coffee & Matcha Powders', 'image' => 'image/shop/japanese mtcha.jpg']);

        Product::create(['subcategory_id' => $subEquipment->id, 'name' => 'Ceramic Mug', 'price' => 150, 'image' => 'image/shop/Ceramic Mug.jpg', 'description' => 'High quality ceramic mug.', 'stock' => 50, 'is_featured' => false]);
        Product::create(['subcategory_id' => $subEquipment->id, 'name' => 'Reusable Cup', 'price' => 120, 'image' => 'image/shop/reusable.jpg', 'description' => 'Eco-friendly reusable cup.', 'stock' => 50, 'is_featured' => true]);
        Product::create(['subcategory_id' => $subEquipment->id, 'name' => 'Thermal Flask', 'price' => 250, 'image' => 'image/shop/thermal.jpg', 'description' => 'Keeps your drinks hot or cold.', 'stock' => 50, 'is_featured' => true]);
        Product::create(['subcategory_id' => $subEquipment->id, 'name' => 'To Go Cup', 'price' => 100, 'image' => 'image/shop/to go cup.jpg', 'description' => 'Stylish to-go cup.', 'stock' => 50, 'is_featured' => false]);

        Product::create(['subcategory_id' => $subPowders->id, 'name' => 'Doncafé Beans', 'price' => 300, 'image' => 'image/shop/Doncafé.jpg', 'description' => 'Premium Doncafé beans.', 'stock' => 50, 'is_featured' => true]);
        Product::create(['subcategory_id' => $subPowders->id, 'name' => 'Nescafé Blend', 'price' => 200, 'image' => 'image/shop/Nescafé.jpg', 'description' => 'Classic Nescafé blend.', 'stock' => 50, 'is_featured' => false]);
        Product::create(['subcategory_id' => $subPowders->id, 'name' => 'Ade Leaf Matcha', 'price' => 450, 'image' => 'image/shop/ade leaf matcha.jpg', 'description' => 'Authentic Ade Leaf Matcha.', 'stock' => 50, 'is_featured' => false]);
        Product::create(['subcategory_id' => $subPowders->id, 'name' => 'Japanese Matcha Powder', 'price' => 500, 'image' => 'image/shop/japanese mtcha.jpg', 'description' => 'Ceremonial grade Japanese Matcha.', 'stock' => 50, 'is_featured' => true]);
        Product::create(['subcategory_id' => $subPowders->id, 'name' => 'Turkish Matcha', 'price' => 400, 'image' => 'image/shop/turkish matcha.jpg', 'description' => 'Special Turkish Matcha blend.', 'stock' => 50, 'is_featured' => false]);
    }
}
