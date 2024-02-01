<?php

namespace App\Services;

use App\Core\Logger\Log;
use App\Enum\General;
use App\Enum\ErrorCodes;
use App\Exceptions\ApiException;
use App\Contracts\Repositories\TagRepositoryInterface;
use App\Helpers\Common;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;

class TagService extends BaseService
{
    /**
     * Constructor
     *
     * @param TagRepositoryInterface $tagRepository
     */
    public function __construct(
        protected TagRepositoryInterface $tagRepository
    )
    {
        $this->repository = $this->tagRepository;
    }

    /**
     * Create new tag
     * @param array $request
     * @return mixed
     * @throws ApiException
     * @throws Exception
     */
    public function store(array $request = []): mixed
    {
        if ($tag = $this->tagRepository->create($request)) :
            return $tag;
        endif;
        Log::error('error', __('message.common.error.bad_request'));

        throw new ApiException(ErrorCodes::BAD_REQUEST);
    }

    /**
     * Show tag detail
     * @param int $id
     * @return mixed
     * @throws ApiException
     */
    public function show(int $id): mixed
    {
        $tag = $this->tagRepository->find($id);

        if (!$tag) :
            throw new ApiException(
                ErrorCodes::NOT_FOUND,
                __('message.error.not_found')
            );
        endif;

        return $tag;
    }

    /**
     * Update tag
     * @param int $id
     * @param array $request
     * @return false|mixed
     * @throws ApiException
     */
    public function update(int $id, array $request = []): mixed
    {
        if ($tag = $this->tagRepository->update($id, $request)) :
            return $tag;
        endif;

        throw new ApiException(ErrorCodes::NOT_FOUND);
    }

    /**
     * Delete tag
     * @param int $id
     * @return bool
     * @throws ApiException
     */
    public function destroy(int $id): bool
    {
        if ($this->tagRepository->delete($id)) :
            return true;
        endif;

        throw new ApiException(
            ErrorCodes::NOT_FOUND,
            __('message.error.not_found')
        );
    }
}
