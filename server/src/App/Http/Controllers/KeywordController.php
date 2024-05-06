<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKeywordRequest;
use App\Http\Resources\KeywordResource;
use Domains\Article\Repositories\Keywords;
use Domains\Article\ValueObjects\Id;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Symfony\Component\HttpFoundation\Response;

class KeywordController extends Controller
{
    public function __construct(
        private readonly Keywords $keywords
    )
    {
    }

    public function index(): ResourceCollection
    {
        return KeywordResource::collection($this->keywords->all());
    }

    public function store(StoreKeywordRequest $request): KeywordResource
    {
        $keyword = $request->convert();

        $keyword = $this->keywords->add($keyword);

        return new KeywordResource($keyword, Response::HTTP_CREATED);
    }

    public function destroy(string $id): Response
    {
        $this->keywords->removeById(new Id($id));

        return response(status: Response::HTTP_NO_CONTENT);
    }
}
