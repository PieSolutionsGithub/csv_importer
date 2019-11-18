<?php
namespace App\Repositories;
use App\Models\Customer;
use App\Services\CustomerService;


class CustomerRepository implements CustomerService{

	protected $customer;

	public function __construct(Customer $customer){
		$this->model = $customer;
	}

	public function CustomerCreate(array $attributes){
		return $this->model->create($attributes);
	}



}