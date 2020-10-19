<?php


namespace App\Service;


use App\Model\Article;
use App\Model\ArticlesContent;
use App\Model\Tag;

class ArticleService
{
    public function findOne($id)
    {
        return Article::with('content', 'category')->findOrFail($id);
    }

    public function pageList()
    {
        return Article::with('content', 'category')->paginate(2);
    }

    public function add($params)
    {
        // TODO 增加文章需要先选中分类
        $article = new Article();
        $article->title = $params['title'];
        $article->category_id = $params['category_id'];
        $article->save();
        $articlesContent = new ArticlesContent();
        $articlesContent->content = $params['content'];
        $articlesContent->article_id = $article->id;
        $articlesContent->save();
        $article->content = $articlesContent;
        return $article;
    }

    public function update($params)
    {
        $article = Article::query()->find($params['id']);
        $article->title = $params['title'] ?? $article->title;
        $article->category_id = $params['category_id'] ?? $article->category_id;
        $article->save();
        $articlesContent = ArticlesContent::query()->where(['article_id' => $params['id']])->first();
        if (isset($params['content'])) {
            $articlesContent->content = $params['content'];
            $articlesContent->save();
        }
        $article->content = $articlesContent;
        return $article;
    }

    public function delete($id)
    {
        //return Article::destroy($id);
        try {
            Article::query()->find($id)->delete();
        } catch (\Throwable $e) {
            throw new $e('删除文章失败', 400);
        }
    }

    public function addTags($params)
    {
        $article = Article::query()->find($params['id']);
        $tag = Tag::query()->find($params['tag_id']);
        $article->tags()->attach($tag);
    }

    public function deleteTags($params)
    {
        $article = Article::query()->find($params['id']);
        $tag = Tag::query()->find($params['tag_id']);
        $article->tags()->detach($tag);
    }

}