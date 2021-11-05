<?php
namespace Usage\V1\Rest\Customer;

use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;
use Zend\Paginator\Paginator as ZendPaginator;
use User\Mapper\UserProfile as UserProfileMapper;
use Usage\Mapper\Customer as CustomerMapper;
use Usage\Mapper\CustomerTrait as CustomerMapperTrait;
use User\Mapper\UserProfileTrait as UserProfileMapperTrait;
use ZF\Rest\AbstractResourceListener;

class CustomerResource extends AbstractResourceListener
{
    use 
    CustomerMapperTrait,
    UserProfileMapperTrait;
    protected $customerService;

    public function __construct(
        UserProfileMapper $userProfileMapper,
        CustomerMapper $customerMapper
    ) {
        $this->setUserProfileMapper($userProfileMapper);
        $this->setCustomerMapper($customerMapper);
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
        $now = new \DateTime('now');
        $inputFilter = $this->getInputFilter();

        try {
            
            if (is_null($inputFilter->getValue('isActive'))) {
                $inputFilter->get('isActive')->setValue(1);
            }

            $inputFilter->add(['name' => 'createdAt']);
            $inputFilter->get('createdAt')->setValue($now);

            $inputFilter->add(['name' => 'updatedAt']);
            $inputFilter->get('updatedAt')->setValue($now);

            $result = $this->getCustomerService()->save($inputFilter);
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
            $customer = $this->getCustomerMapper()->fetchOneBy(['uuid' => $id]);
            if (is_null($customer)) {
                return new ApiProblem(404, "Data pelanggan tidak ditemukan");
            }

            return $this->getCustomerService()->delete($customer);
        } catch (\RuntimeException $e) {
            return new ApiProblemResponse(new ApiProblem(500, $e->getMessage()));
        }

        return $customer;
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

        $customer = $this->getCustomerMapper()->fetchOneBy($queryParams);
        if (is_null($customer)) {
            return new ApiProblemResponse(new ApiProblem(404, "Data pelanggan tidak ditemukan"));
        }

        return $customer;
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
        $qb = $this->getCustomerMapper()->fetchAll($queryParams, $order, $asc);
        $paginatorAdapter = $this->getCustomerMapper()->createPaginatorAdapter($qb);
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
        $customer = $this->getCustomerMapper()->fetchOneBy(['uuid' => $id]);
        if (is_null($customer)) {
            return new ApiProblemResponse(new ApiProblem(404, "Data pelanggan tidak ditemukan!"));
        }
        $inputFilter = $this->getInputFilter();

        $this->getCustomerService()->update($customer, $inputFilter);
        return $customer;
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
     * Get the value of customerService
     */
    public function getCustomerService()
    {
        return $this->customerService;
    }

    /**
     * Set the value of customerService
     *
     * @return  self
     */
    public function setCustomerService($customerService)
    {
        $this->customerService = $customerService;

        return $this;
    }
}
