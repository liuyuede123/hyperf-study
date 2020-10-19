<?php

declare(strict_types=1);

use Hyperf\Database\Seeders\Seeder;

class ArticleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 30; $i++) {
            $article = new \App\Model\Article();
            $article->title = '文章标题' . \Hyperf\Utils\Str::random(10);
            $article->save();
            $articlesContent = new \App\Model\ArticlesContent();
            $articlesContent->article_id = $article->id;
            $articlesContent->content = '文章内容' . \Hyperf\Utils\Str::random(10);
            $articlesContent->save();
        }
    }
}
