<?php

namespace App\Helpers;
use Carbon\Carbon;

class Helper{

    public static function uploadCsv($file){

   		  $filename = $file->getClientOriginalName();
		  $extension = $file->getClientOriginalExtension();
		  $tempPath = $file->getRealPath();
		  $fileSize = $file->getSize();
		  $mimeType = $file->getMimeType();
		  $location = 'uploads';
		  $file->move($location,$filename);
          $filepath = public_path($location."/".$filename);
		  $file = fopen($filepath,"r");
		  
		  $importData_arr = array();
		  $i = 0;
		  
		  while (($filedata = fgetcsv($file, 10000, ",")) !== FALSE) {
			 $num = count($filedata );
			 
			 // Skip first row 
			 if($i == 0){
				$i++;
				continue; 
			 }
			 for ($c=0; $c < $num; $c++) {
				$importData_arr[$i][] = $filedata [$c];
			 }
			 $i++;
		  }
		  fclose($file);
		  
		  return $importData_arr;
    }
    public static function check_data($importData){
		$check_data_type = is_numeric($importData[0]); 
		$invoice_amount  = is_numeric($importData[1]); 
		$invoice_date    = date("Y-d-m",strtotime($importData[2]));
		$now             = Carbon::today()->toDateString();
		$test_arr        = explode('/', $importData[2]);

		return compact(['check_data_type', 'invoice_amount', 'invoice_date', 'now', 'test_arr']);
    }
    public static function check_coefficient($invoice_date,$importData){
    	$now             = Carbon::today()->toDateString();
    	$datediff = strtotime($now) - strtotime($invoice_date);
        $invoice_date = date("Y-m-d",strtotime($importData[2]));
        $days =  round($datediff / (60 * 60 * 24));
        $arr = explode(".",$days);
        $days = $arr[0];
        if($days >= 30){
            $percentage = 0.5;
            $invoce_amount = $importData[1];
            $numberToAdd = ($invoce_amount / 100) * $percentage;
            $selling_price = $invoce_amount + $numberToAdd;
        }else{
            $percentage = 0.3;
            $invoce_amount = $importData[1];
            $numberToAdd = ($invoce_amount / 100) * $percentage;
            $selling_price = $invoce_amount + $numberToAdd;
        }
        return compact(['percentage','invoce_amount','numberToAdd','selling_price','invoice_date']);
    }

}

 



