<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\CategoryService;
use App\Util\Response;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;

class CategoryController
{
    /**
     * @Inject
     * @var CategoryService
     */
    protected $categoryService;

    public function index(RequestInterface $request, ResponseInterface $response)
    {
        $type = $request->route('type');
        $params = ['type' => $type];
        $articles = $this->categoryService->pageList($params);
        return $response->json(Response::array(200, 'success', $articles));
    }

    public function info(RequestInterface $request, ResponseInterface $response)
    {
        $id = $request->route('id');
        $article = $this->categoryService->findOne($id);
        return $response->json(Response::array(200, 'success', $article));
    }

    public function add(RequestInterface $request, ResponseInterface $response)
    {
        $name = $request->post('name');
        $type = $request->post('type');
        $parent_id = $request->post('parent_id', 0);
        $weight = $request->post('weight', 0);
        $params = [
            'name' => $name,
            'type' => $type,
            'parent_id' => $parent_id,
            'weight' => $weight,
        ];
        $article = $this->categoryService->add($params);
        return $response->json(Response::array(200, 'success', $article));
    }

    public function update(RequestInterface $request, ResponseInterface $response)
    {
        $id = $request->post('id');
        $name = $request->post('name');
        $type = $request->post('type');
        $parent_id = $request->post('parent_id', 0);
        $weight = $request->post('weight', 0);
        $params = [
            'id' => $id,
            'name' => $name,
            'type' => $type,
            'parent_id' => $parent_id,
            'weight' => $weight,
        ];
        $article = $this->categoryService->update($params);
        return $response->json(Response::array(200, 'success', $article));
    }

    public function delete(RequestInterface $request, ResponseInterface $response)
    {
        $id = $request->post('id');
        $this->categoryService->delete($id);
        return $response->json(Response::array(200, 'success'));
    }
}
