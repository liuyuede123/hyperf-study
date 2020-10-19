<?php


namespace App\Service;


use App\Model\Tag;

class TagService
{
    public function findOne($id)
    {
        return  Tag::query()->with('articles.content')->findOrFail($id);
    }

    public function pageList($params)
    {
        return Tag::query()->get();
    }

    public function add($params)
    {
        $tag = new Tag();
        $tag->name = $params['name'];
        $tag->save();
        return $tag;
    }

    public function update($params)
    {
        $tag = Tag::query()->find($params['id']);
        $tag->name = $params['name'] ?? $tag->name;
        $tag->save();
        return $tag;
    }

    public function delete($id)
    {
        // return Tag::destroy($id);
        try {
            Tag::query()->find($id)->delete();
        } catch (\Throwable $e) {
            throw new $e('删除标签失败', 400);
        }
    }
}