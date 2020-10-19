<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\TagService;
use App\Util\Response;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;

class TagController
{
    /**
     * @Inject
     * @var TagService
     */
    protected $tagService;

    public function index(RequestInterface $request, ResponseInterface $response)
    {
        $params = [];
        $tags = $this->tagService->pageList($params);
        return $response->json(Response::array(200, 'success', $tags));
    }

    public function info(RequestInterface $request, ResponseInterface $response)
    {
        $id = $request->route('id');
        $article = $this->tagService->findOne($id);
        return $response->json(Response::array(200, 'success', $article));
    }

    public function add(RequestInterface $request, ResponseInterface $response)
    {
        $name = $request->post('name');
        $params = [
            'name' => $name,
        ];
        $article = $this->tagService->add($params);
        return $response->json(Response::array(200, 'success', $article));
    }

    public function update(RequestInterface $request, ResponseInterface $response)
    {
        $id = $request->post('id');
        $name = $request->post('name');
        $params = [
            'id' => $id,
            'name' => $name,
        ];
        $article = $this->tagService->update($params);
        return $response->json(Response::array(200, 'success', $article));
    }

    public function delete(RequestInterface $request, ResponseInterface $response)
    {
        $id = $request->post('id');
        $this->tagService->delete($id);
        return $response->json(Response::array(200, 'success'));
    }
}
