<?php
namespace Usage\V1\Rest\Usage;

use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;
use Zend\Paginator\Paginator as ZendPaginator;
use User\Mapper\UserProfile as UserProfileMapper;
use User\Mapper\UserProfileTrait as UserProfileMapperTrait;
use Usage\Mapper\Usage as UsageMapper;
use Usage\Mapper\UsageTrait as UsageMapperTrait;
use ZF\Rest\AbstractResourceListener;

class UsageResource extends AbstractResourceListener
{
    use UsageMapperTrait;
    use UserProfileMapperTrait;
    protected $usageService;

    public function __construct(
        UserProfileMapper $userProfileMapper,
        UsageMapper $usageMapper
    ) {
        $this->setUserProfileMapper($userProfileMapper);
        $this->setUsageMapper($usageMapper);
    }

    /**
     * Create a resource
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function create($data)
    {
        $data = (array) $data;
        $inputFilter = $this->getInputFilter();

        try {
            $inputFilter->add(['name' => 'createdAt']);
            $inputFilter->get('createdAt')->setValue(new \DateTime('now'));

            $inputFilter->add(['name' => 'updatedAt']);
            $inputFilter->get('updatedAt')->setValue(new \DateTime('now'));

            $result = $this->getUsageService()->save($inputFilter);
        } catch (\RuntimeException $e) {
            return new ApiProblemResponse(new ApiProblem(500, $e->getMessage()));
        }

        return $result;
    }

    /**
     * Delete a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function delete($id)
    {
        try {
            $usage = $this->getUsageMapper()->fetchOneBy(['uuid' => $id]);
            if (is_null($usage)) {
                return new ApiProblem(404, "Data penggunaan tidak ditemukan");
            }

            return $this->getUsageService()->delete($usage);
        } catch (\RuntimeException $e) {
            return new ApiProblemResponse(new ApiProblem(500, $e->getMessage()));
        }

        return $usage;
    }

    /**
     * Delete a collection, or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function deleteList($data)
    {
        return new ApiProblem(405, 'The DELETE method has not been defined for collections');
    }

    /**
     * Fetch a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function fetch($id)
    {
        $queryParams = [
            'uuid' => $id,
        ];

        $usage = $this->getUsageMapper()->fetchOneBy($queryParams);
        if (is_null($usage)) {
            return new ApiProblemResponse(new ApiProblem(404, "Data penggunaan tidak ditemukan"));
        }

        return $usage;
    }

    /**
     * Fetch all or a subset of resources
     *
     * @param  array $params
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = [])
    {
        $queryParams =  $params->toArray();

        $order = null;
        $asc = false;

        if (isset($queryParams['order'])) {
            $order = $queryParams['order'];
            unset($queryParams['order']);
        }

        if (isset($queryParams['ascending'])) {
            $asc = $queryParams['ascending'];
            unset($queryParams['ascending']);
        }
        $qb = $this->getUsageMapper()->fetchAll($queryParams, $order, $asc);
        $paginatorAdapter = $this->getUsageMapper()->createPaginatorAdapter($qb);
        return new ZendPaginator($paginatorAdapter);
    }

    /**
     * Patch (partial in-place update) a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function patch($id, $data)
    {
        $usage = $this->getUsageMapper()->fetchOneBy(['uuid' => $id]);
        if (is_null($usage)) {
            return new ApiProblemResponse(new ApiProblem(404, "Data penggunaan tidak ditemukan!"));
        }
        $inputFilter = $this->getInputFilter();

        $this->getUsageService()->update($usage, $inputFilter);
        return $usage;
    }

    /**
     * Patch (partial in-place update) a collection or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function patchList($data)
    {
        return new ApiProblem(405, 'The PATCH method has not been defined for collections');
    }

    /**
     * Replace a collection or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function replaceList($data)
    {
        return new ApiProblem(405, 'The PUT method has not been defined for collections');
    }

    /**
     * Update a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function update($id, $data)
    {
        return new ApiProblem(405, 'The PUT method has not been defined for individual resources');
    }

    /**
     * Get the value of usageService
     */
    public function getUsageService()
    {
        return $this->usageService;
    }

    /**
     * Set the value of usageService
     *
     * @return  self
     */
    public function setUsageService($usageService)
    {
        $this->usageService = $usageService;

        return $this;
    }
}
