<?php


namespace App\Http\Controllers;

use App\Nidas;
use App\RSSB;
use App\RRA;


use Illuminate\Http\Request;
use Illuminate\Http\Response;



class CreditScoreController extends Controller
{

   public function create_nida(Request $request){

       $nida = new Nidas();
       $nida->names=$request->name;	
       $nida->dob=$request->dob;		
       $nida->location=$request->location;	
       $nida->personal_id=$request->personal_id;

       $nida->save();

       $this->create_nida_handle($request->name,$request->dob,$request->location,$request->personal_id);
          }


    public function create_nida_handle($names,$dob,$location,$personal_id){


    	$method ='POST';
        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: LBE7YRZPUCOCLQOXBMPJUWKS0EMUZ8MJ';
        $url ='https://197.243.0.244:8880/25.001/CREDITSCORE/'.$personal_id;
     	$data = '
        			{
	                    "authkey": "LGAGZYYRP5SUYPKPHQLFW9NGKUHHZJBC",
	                    "handleid": "25.001\/CREDITSCORE\/'.$personal_id.'",
	                    "values": 
	                    [
	                    	{
			                    "type": "CITIZEN_INDENTIFIER",
			                    "value":"'.$personal_id.'",
			                    "adminRead": true,
			                    "adminWrite": true,
			                    "publicRead": true,
			                    "publicWrite": false,
			                    "index": "1001"                
		                    }, 
		                    {
			                   "type":"NAMES",
			                   "value":"'.$names.'",
			                   "adminRead": true,
			                   "adminWrite": true,
			                   "publicRead": true,
			                    "publicWrite": false,
			                    "index": "1002"      
		                    },
		                    {
			                   "type":"LOCATION",
			                   "value":"'.$location.'",
			                   "adminRead": true,
			                   "adminWrite": true,
			                   "publicRead": true,
			                    "publicWrite": false,
			                    "index": "1003"      
		                    },
		                    {
			                   "type":"DATE_OF_BIRTH",
			                   "value":"'.$dob.'",
			                   "adminRead": true,
			                   "adminWrite": true,
			                   "publicRead": true,
			                    "publicWrite": false,
			                    "index": "1004"      
		                    }
						]
              		}
              	';
               
             
      //phpinfo();

        
       $curl = curl_init();
        curl_setopt_array($curl, array(
	        	CURLOPT_RETURNTRANSFER => true,
                CURLOPT_SSL_VERIFYHOST => false,
                CURLOPT_SSL_VERIFYPEER =>false,
	       		CURLOPT_URL => $url,
	        	CURLOPT_CUSTOMREQUEST => $method,
	        	CURLOPT_HTTPHEADER => $headers,
				CURLOPT_POSTFIELDS => ($data)
	    ));
        $output = curl_exec($curl);
        echo $output;
        $err = curl_error($curl);
        curl_close($curl);    
	    if ($err) {
	    	echo "cURL Error #:" . $err;
	    } else {
           	echo "1";
           }
        
    }

    public function get_nida_data(){
      
         $nida=new Nidas;
         $nida = $nida->get();
         
         if($nida){

            
             return response()->json($nida,200);

         }else{
         	
             return response()->json(['success'=>0, 'failure'=>1,'message'=>'Nida data not found'],400);
         }

    }
}
