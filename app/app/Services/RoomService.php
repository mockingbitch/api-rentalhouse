<?php

namespace App\Services;

use App\Contracts\Repositories\RoomRepositoryInterface;
use App\Core\File\FileService;
use App\Core\Logger\Log;
use App\Enum\ErrorCodes;
use App\Enum\General;
use App\Enum\HouseEnum;
use App\Exceptions\ApiException;
use App\Helpers\Common;
use App\Helpers\ResponseHelper;
use Exception;

class RoomService extends BaseService
{
    /**
     * Constructor
     *
     * @param RoomRepositoryInterface $roomRepository
     */
    public function __construct(
        protected RoomRepositoryInterface $roomRepository,
    )
    {
        $this->repository = $this->roomRepository;
    }

    /**
     * List House
     *
     * @param array $request
     * @return array
     */
    public function listRoom(array $request = []): array
    {
        $page     = Common::getPageSize($request)['current_page'];
        $pageSize = Common::getPageSize($request)['page_size'];
        try {
            $condition = $this->buildCondition($request);
            if (isset($request['name'])) :
                $condition[] = [
                    'name',
                    'like',
                    '%' . $request['name'] . '%'
                ];
            endif;
            if (isset($request['province_code'])) :
                $condition[] = [
                    'province_code' => $request['province_code']
                ];
            endif;
            if (isset($request['district_code'])) :
                $condition[] = [
                    'district_code' => $request['district_code']
                ];
            endif;
            if (isset($request['ward_code'])) :
                $condition[] = [
                    'ward_code' => $request['ward_code']
                ];
            endif;
            if (isset($request['category_id'])) :
                $condition[] = [
                    'category_id' => $request['category_id']
                ];
            endif;
            $data = $this->roomRepository->query()
                ->where($condition)
                ->with(['lessor', 'rooms'])
                ->orderBy('id', General::SORT_DESC)
                ->paginate($pageSize, ['*'], 'page', $page);

            return ResponseHelper::list($data, $request);
        } catch (Exception $exception) {
            return ResponseHelper::list([], $request);
        }
    }

    /**
     * Store new house
     *
     * @param array $request
     * @return mixed
     * @throws ApiException
     */
    public function storeRoom(array $request = []): mixed
    {
        try {
            $request['lessor_id'] = auth()->user()->id;
            $request['thumbnail'] = FileService::storeFile(
                $request['thumbnail'],
                HouseEnum::FILE_PATH->value
            );

            return $this->roomRepository->create($request);
        } catch (Exception $exception) {
            throw new ApiException(ErrorCodes::BAD_REQUEST);
        }
    }

    /**
     * Update house by Id
     *
     * @param int $id
     * @param array $request
     * @return mixed
     * @throws ApiException
     */
    public function updateRoom(int $id, array $request = []): mixed
    {
        try {
            if (!$room = $this->roomRepository->find($id)) :
                throw new ApiException(
                    ErrorCodes::NOT_FOUND,
                    __('message.error.not_found')
                );
            endif;
//            FileService::removeFile(
//                $house->thumbnail,
//                HouseEnum::FILE_PATH->value
//            );
            $request['thumbnail'] = FileService::storeFile(
                $request['thumbnail'],
                HouseEnum::FILE_PATH->value
            );

        } catch (Exception $exception) {
            throw new ApiException(ErrorCodes::BAD_REQUEST);
        }
    }
}
