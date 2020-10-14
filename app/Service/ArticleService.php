<?php


namespace App\Service;


use App\Model\Article;

class ArticleService
{
    public function findOne($id)
    {
        return Article::query()->findOrFail($id);
    }

    public function pageList()
    {
        return Article::all();
    }

    public function add($params)
    {
        $article = new Article();
        $article->title = $params['title'];
        $article->content = $params['content'];
        $article->save();
        return $article;
    }

    public function update($params)
    {
        $article = Article::query()->find($params['id']);
        $article->title = $params['title'];
        $article->save();
        return $article;
    }

    public function delete($id)
    {
        return Article::destroy($id);
        /*try {
            Article::query()->find($id)->delete();
        } catch (\Throwable $e) {
            throw new $e('删除文章失败', 400);
        }*/
    }

}