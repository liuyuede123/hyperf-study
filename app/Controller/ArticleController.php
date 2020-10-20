<?php

declare(strict_types=1);

namespace App\Controller;

use App\Request\ArticleRequest;
use App\Service\ArticleService;
use App\Service\CategoryService;
use App\Util\Response;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;

// TODO 注解形式添加路由
class ArticleController
{
    /**
     * @Inject
     * @var ArticleService
     */
    protected $articleService;

    public function index(RequestInterface $request, ResponseInterface $response)
    {
        $articles = $this->articleService->pageList();
        return $response->json(Response::array(200, 'success', $articles));
    }

    public function info(RequestInterface $request, ResponseInterface $response)
    {
        $id = $request->route('id');
        $article = $this->articleService->findOne($id);
        return $response->json(Response::array(200, 'success', $article));
    }

    public function add(ArticleRequest $request, ResponseInterface $response)
    {
        $title = $request->post('title');
        $content = $request->post('content');
        $category_id = $request->post('category_id');
        $params = ['title' => $title, 'content' => $content, 'category_id' => $category_id];
        $article = $this->articleService->add($params);
        return $response->json(Response::array(200, 'success', $article));
    }

    public function update(RequestInterface $request, ResponseInterface $response)
    {
        $id = $request->post('id');
        $title = $request->post('title');
        $content = $request->post('content');
        $category_id = $request->post('category_id');
        $params = ['title' => $title, 'content' => $content, 'category_id' => $category_id, 'id' => $id];
        $article = $this->articleService->update($params);
        var_dump(json_encode($article, JSON_UNESCAPED_UNICODE));
        return $response->json(Response::array(200, 'success', $article));
    }

    public function delete(RequestInterface $request, ResponseInterface $response)
    {
        $id = $request->post('id');
        $this->articleService->delete($id);
        return $response->json(Response::array(200, 'success'));
    }

    public function addTags(RequestInterface $request, ResponseInterface $response)
    {
        $id = $request->post('id');
        $tagId = $request->post('tag_id');
        $params = ['id' => $id, 'tag_id' => $tagId];
        $this->articleService->addTags($params);
        return $response->json(Response::array(200, 'success'));
    }

    public function deleteTags(RequestInterface $request, ResponseInterface $response)
    {
        $id = $request->post('id');
        $tagId = $request->post('tag_id');
        $params = ['id' => $id, 'tag_id' => $tagId];
        $this->articleService->deleteTags($params);
        return $response->json(Response::array(200, 'success'));
    }
}
