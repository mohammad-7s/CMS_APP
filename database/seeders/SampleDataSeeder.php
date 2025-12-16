<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Article;
use App\Models\Comment;
use App\Models\User;

class SampleDataSeeder extends Seeder
{
    public function run()
    {
        // Create categories
        $categories = Category::factory()->count(6)->create();

        // Ensure at least one user exists (admin created earlier). If not, create simple user.
        if (! User::where('email','user@example.com')->exists()) {
            User::factory()->create([
                'email' => 'user@example.com',
                'name' => 'Sample User',
                'password' => bcrypt('password'),
                'role' => 'user',
            ]);
        }

        // Create 30 articles
        Article::factory()->count(30)->create()->each(function ($article) use ($categories) {
            // attach 1-3 categories (works for many-to-many pivot 'article_category')
            try {
                $attach = $categories->random(rand(1, min(3, $categories->count())))->pluck('id')->toArray();
                if (method_exists($article, 'categories')) {
                    $article->categories()->sync($attach);
                } else if (schema_has_column('articles', 'category_id')) {
                    // fallback if one-to-many relation; set first category id
                    $article->category_id = $attach[0];
                    $article->save();
                }
            } catch (\Throwable $e) {
                // ignore attach errors
            }

            // create 0-5 comments for this article
            $num = rand(0,5);
            for ($i=0;$i<$num;$i++){
                $c = Comment::factory()->make();
                $c->article_id = $article->id;
                $c->save();
            }
        });

        $this->command->info('Sample data seeded: categories, articles, comments.');
    }
}
