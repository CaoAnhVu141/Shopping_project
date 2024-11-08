<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //Gọi các seeder ở đây để chạy seeder
        $this->call(CustomersTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(CategoryPostsTableSeeder::class);
        $this->call(PostsTableSeeder::class);
        $this->call(AttributeTableSeeder::class);
        $this->call(PaymentsTableSeeder::class);
        $this->call(EventTableSeeder::class);
        $this->call(DiscountTableSeeder::class); 
        $this->call(ContactTableSeeder::class);
        $this->call(ShippingMethodTableSeeder::class);
        $this->call(AttributeValueTableSeeder::class);
        $this->call(ProductAttributeTableSeeder::class);
        $this->call(FavoriteTableSeeder::class);
        $this->call(ProductTableSeeder::class);
        $this->call(ReviewTableSeeder::class);//chua hoan thanh ảnh
        $this->call(OrdersTableSeeder::class);//cái này khách hàng nhập vào
        $this->call(OrderItemsTableSeeder::class);
        $this->call(ProductDiscountsTableSeeder::class);
        $this->call(OrderItemAttributesTableSeeder::class);
        $this->call(OrderStatusHistoryTableSeeder::class);
        $this->call(ShoppingCartTableSeeder::class);
        $this->call(PostProductTableSeeder::class);
    }
}
    