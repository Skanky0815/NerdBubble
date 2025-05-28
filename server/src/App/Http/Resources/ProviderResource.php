<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Domains\Article\Aggregates\Provider;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Response;

/**
 * @mixin Provider
 */
class ProviderResource extends JsonResource
{
    public function __construct($resource, private readonly int $status = Response::HTTP_OK)
    {
        parent::__construct($resource);
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => (string) $this->id,
            'name' => $this->name,
            'color' => $this->color,
            'logoImage' => $this->logoImage,
            'aggregateUrl' => $this->aggregateUrl,
            'hasProducts' => $this->hasProducts,
            'layout' => $this->layout,
            'isActive' => $this->isActive,
            'articleSelector' => [
                'headline' => $this->articleSelector->headline,
                'subHeadline' => $this->articleSelector->subHeadline,
                'description' => $this->articleSelector->description,
                'image' => $this->articleSelector->image,
                'link' => $this->articleSelector->link,
                'wrapper' => $this->articleSelector->wrapper,
                'dateSelector' => [
                    'date' => $this->articleSelector->dateSelector->date,
                    'format' => $this->articleSelector->dateSelector->format,
                    'locale' => $this->articleSelector->dateSelector->locale,
                    'attribute' => $this->articleSelector->dateSelector->attribute,
                ],
            ],
            'articleHeadline' => $this->articleHeadline,
            'articleImage' => $this->articleImage,
            'articleLink' => $this->articleLink,
        ];
    }

    public function toResponse($request): JsonResponse
    {
        return parent::toResponse($request)->setStatusCode($this->status);
    }
}
