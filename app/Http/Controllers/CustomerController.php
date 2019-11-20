<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CustomerRequest;
use App\Repositories\CustomerRepository;
use App\Services\CustomerService;
use App\Models\Customer;
use App\Models\Message;
use Carbon\Carbon;
use Session;
use DateTime;
use Auth;
use App\Helpers\helper as Helper;


class CustomerController extends Controller
{
    private $customer ;

    public function __construct(CustomerService $customer){

       $this->customer = $customer ;

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request)
    {
        $logged_user_id = Auth::user()->id;
        $file           = $request->file('file');   
        $importData_arr = Helper::uploadCsv($file); 
        $customer       = new customer();

	    foreach($importData_arr as $importData){
		$imp_data = Helper::check_data($importData);
		if($imp_data['check_data_type'] == true && $imp_data['invoice_amount'] == true && count($imp_data['test_arr']) == 3){
                $coefficient = Helper::check_coefficient($imp_data['invoice_date'],$importData);
				$insertData = array(
                   "user_id"             => $logged_user_id,
                   "invoice_number"      => $importData[0],
                   "invoice_amount"      => $importData[1],
                   "due_on"              => $coefficient['invoice_date'],
                   "invoice_sell_amount" => $coefficient['selling_price'],
				);
                $this->customer->CustomerCreate($insertData);
			  }else{
				  if($imp_data['check_data_type'] == false){
					$message = new Message;
					$message->user_id = $logged_user_id;
					$message->message = "Something went wrong in invoice ID : ".$importData[0];
					$message->save();
				  }
				  if($imp_data['invoice_amount'] == false){
					$message = new Message;
					$message->user_id = $logged_user_id;
					$message->message = "Something went wrong in invoice ID : ".$importData[0]. " Message is : ".$importData[1];
					$message->save();
				  }
		}
		  Session::flash('message',"Import Success");
		}
        return redirect()->action('HomeController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
