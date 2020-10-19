<?php


namespace App\Service;


use App\Model\Category;

class CategoryService
{
    public function findOne($id)
    {
        return  Category::with('article.content')->findOrFail($id);
    }

    public function pageList($params)
    {
        $query = Category::query();
        if (!empty($params['type'])) {
            $query->where(['type' => $params['type']]);
        }
        return $query->get();
    }

    public function add($params)
    {
        // TODO 处理path，path_id
        // TODO 处理处理权重，不能相同，加上步数，全局去做
        $category = new Category();
        $category->name = $params['name'];
        $category->type = $params['type'];
        $category->parent_id = $params['parent_id'] ?? 0;
        $category->path = $params['path'] ?? '';
        $category->path_id = $params['path_id'] ?? '';
        $category->weight = $params['weight'] ?? 0;
        $category->save();
        return $category;
    }

    public function update($params)
    {
        // TODO 更新分类层级，子层级同步改动
        $category = Category::query()->find($params['id']);
        $category->name = $params['name'] ?? $category->name;;
        $category->parent_id = $params['parent_id'] ?? $category->parent_id;
        $category->path = $params['path'] ?? $category->path;
        $category->path_id = $params['path_id'] ?? $category->path_id;
        $category->weight = $params['weight'] ?? $category->weight;
        $category->save();
        return $category;
    }

    public function delete($id)
    {
        // TODO 删除分类，分类下文章是否删除，如果有子分类如何处理
        // return Category::destroy($id);
        try {
            Category::query()->find($id)->delete();
        } catch (\Throwable $e) {
            throw new $e('删除分类失败', 400);
        }
    }

}