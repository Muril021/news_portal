<?php

namespace App\Services;

use Illuminate\Http\Request;

abstract class Service
{
    protected $repository;

    public function __construct($repository)
    {
        $this->repository = $repository;
    }

    public function paginated(Request $request)
    {
        $filters = $this->filters($request);
        return $this->repository->fetchAll([
            ...$filters,
            'paginated' => true,
        ]);
    }


    public function fetchAll(Request $request)
    {
        $filters = $this->filters($request);

        return $this->repository->fetchAll($filters);
    }

    public function first(Request $request)
    {
        return $this->repository->first(
            $this->filters($request),
        );
    }

    public function findOrFail(Request $request, int $id)
    {
        return $this->repository->findOrFail(
            $id,
            $this->filters($request),
        );
    }

    public function find(int $id, Request $request)
    {
        return $this->repository->find($id);
    }

    public function save(array $data)
    {
        $data['id'] = $data['id'] ?? null;
        if (!$data['id']) {
            return $this->create($data);
        }

        return $this->update($data);
    }

    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    public function update(array $data)
    {
        return $this->repository->update($data);
    }

    public function updateOrCreate(array $data)
    {
        return $this->repository->updateOrCreate($data);
    }

    public function firstOrCreate(array $data)
    {
        return $this->repository->firstOrCreate($data);
    }

    public function delete(int $id)
    {
        return $this->repository->delete($id);
    }

    public function forceDelete(int $id)
    {
        return $this->repository->forceDelete($id);
    }

    public function restore(int $id)
    {
        return $this->repository->restore($id);
    }

    public function getModel()
    {
        return $this->repository->getModel();
    }

    public function count()
    {
        return $this->getModel()->count();
    }

    protected function filters(Request $request): array
    {
        $filter = [];

        $columns = $request->get('columns');
        $orderBy = $request->get('orderBy');
        $sortBy = $request->get('sortBy');
        $perPage = $request->get('perPage');
        $paginated = $request->get('paginated');
        $limit = $request->get('limit');
        $offset = $request->get('offset');
        $relations = $request->get('relations') ?? [];

        $filter['columns'] = isset($columns) ? explode(',', $columns) : '*';
        $filter['orderBy'] = $orderBy ?? 'desc';
        $filter['sortBy'] = $sortBy ?? 'id';
        $filter['paginated'] = isset($paginated) && $paginated == 'true' ? true : false;
        $filter['perPage'] = $perPage ?? 15;
        $filter['limit'] = $limit ?? 15;
        $filter['offset'] = $offset ?? 0;
        $filter['relations'] = is_array($relations) ? $relations : [$relations];

        return $filter;
    }

    protected function getPaginatedData($items, $mappedItems)
    {
        return [
            'current_page' => $items->currentPage(),
            'data' => $mappedItems,
            'first_page_url' => $items->url(1),
            'from' => $items->firstItem(),
            'last_page' => $items->lastPage(),
            'last_page_url' => $items->url($items->lastPage()),
            'links' => $items->toArray()['links'],
            'next_page_url' => $items->nextPageUrl(),
            'path' => $items->path(),
            'per_page' => $items->perPage(),
            'prev_page_url' => $items->previousPageUrl(),
            'to' => $items->lastItem(),
            'total' => $items->total(),
        ];
    }
}
