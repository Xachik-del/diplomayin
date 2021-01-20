<?php

use Illuminate\Database\Seeder;

class BlogCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = array();

        $categoryName = "Without Category";
        $categories[] = [
            'title' => $categoryName,
            'slug' => \Illuminate\Support\Str::slug($categoryName),
            'parent_id' => 0,
        ];

        for ($i = 1; $i <= 10; $i++) {
            $categoryName = 'Category #' . $i;
            $parentId = ($i > 4) ? rand(1, 4) : 1;

            $categories[] = [
                'title' => $categoryName,
                'slug' => \Illuminate\Support\Str::slug($categoryName),
                'parent_id' => $parentId,
            ];
        }

        \Illuminate\Support\Facades\DB::table('blog_categories')->insert($categories);
    }
}
