<?php

namespace App\Services;

use App\Contracts\Repositories\HouseRepositoryInterface;
use App\Core\File\FileService;
use App\Enum\ErrorCodes;
use App\Enum\General;
use App\Exceptions\ApiException;
use App\Helpers\Common;
use App\Helpers\ResponseHelper;
use App\Models\House\Definitions\HouseDefs;
use Exception;

class HouseService extends BaseService
{
    /**
     * Constructor
     *
     * @param HouseRepositoryInterface $houseRepository
     */
    public function __construct(
        protected HouseRepositoryInterface $houseRepository,
    )
    {
        $this->repository = $this->houseRepository;
    }

    /**
     * List House
     *
     * @param array $request
     * @return array
     */
    public function listHouse(array $request = []): array
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
            $data = $this->houseRepository->query()
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
    public function storeHouse(array $request = []): mixed
    {
        try {
            $request['lessor_id'] = auth()->user()->id;
            if ($request['thumbnail']) :
                $request['thumbnail'] = FileService::storeFile(
                    $request['thumbnail'],
                    HouseDefs::FILE_PATH
                );
            endif;
            if (isset($request['method']) && $request['method'] == General::REQUEST_METHOD_DRAFT) :
                $request['status'] = HouseDefs::STATUS_DRAFT;
            endif;

            return $this->houseRepository->create($request);
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
    public function updateHouse(int $id, array $request = []): mixed
    {
        try {
            if (!$house = $this->houseRepository->find($id)) :
                throw new ApiException(
                    ErrorCodes::NOT_FOUND,
                    __('message.error.not_found')
                );
            endif;
//            FileService::removeFile(
//                $house->thumbnail,
//                HouseDefs::FILE_PATH
//            );
            $request['thumbnail'] = FileService::storeFile(
                $request['thumbnail'],
                HouseDefs::FILE_PATH
            );

            return $this->houseRepository->update($id, $request);
        } catch (Exception $exception) {
            throw new ApiException(ErrorCodes::BAD_REQUEST);
        }
    }

    public function getTop()
    {
        return 5;
    }
}
