<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Question;
use App\Models\UserRequest;
use OpenAI\Laravel\Facades\OpenAI;
use App\Services\ErrorLog;

class OpenAIController extends Controller
{
    
    public function sendRequest(Request $request) {

    	try{

    		$input = $request->all();
    		$search = "Create a valid JSON array of objects to list 12 ";
    		$search .= $input['question_type']." questions and answer on topics".$input['user_input'];
    	

    		$result = OpenAI::completions()->create([
			    'model' => 'gpt-3.5-turbo-instruct',
			    'prompt' => $search,
			    'max_tokens' => 1500,
			]);

		
        	$question = $result->choices[0]->text;

        	$insert = new UserRequest();
        	$insert->user_input = json_encode($input['user_input']);
        	$insert->question_type = $input['question_type'];
        	$insert->assistant_output = $question;
        	$insert->input_token = $result->usage->promptTokens;
        	$insert->output_token = $result->usage->completionTokens;
        	$insert->save();

        	return view('show-result', ['question'=>json_decode($question,true), 'id'=>$insert->id,'input'=>$input]);

    	}catch(Exception $e) {

            ErrorLog::log($e->getMessage(), 'error', __METHOD__);
            return view('send-request');
        }
    	
    }

    public function getQuestions(Request $request) {

    	try{

    		$data = Question::paginate(10);
    		return view('question-bank', ['question'=>$data]);

    	}catch(Exception $e) {

            ErrorLog::log($e->getMessage(), 'error', __METHOD__);
            return view('send-request');
        }
    }

    public function saveQuestions(Request $request){

    	try{

    		$req_id = $request->input('req_id');

    		if($req_id){

    			$data = UserRequest::find($req_id);

    			$quesions = json_decode($data->assistant_output,true);
    			if(!empty($quesions)) {

    				foreach ($quesions as $key => $value) {

    					$insert = new Question();
    					$insert->request_id = $req_id;

    					if($data->question_type == 'Multiple Choice Questions'){
    						$temp = '<p>'.$value['question'].'</p><br>';

    						if(isset($value['options']) && !empty($value['options'])){

    							$temp .='<ol>';
    							 foreach($value['options'] as $i=> $o){
    							 	 $temp .='<li>'.$o.'</li>';
    							 }
                         		$temp .='</ol>';
    						}elseif (isset($value['choices']) && !empty($value['choices'])) {
    							$temp .='<ol>';
    							 foreach($value['choices'] as $i=> $o){
    							 	 $temp .='<li>'.$o.'</li>';
    							 }
                         		$temp .='</ol>';
    						}
                       	
    						$insert->question = $temp;
    					}else{
    						$insert->question = $value['question'];
    					}

    					if(isset($value['answer'])){
    						$insert->answer = $value['answer'];
    					}elseif(isset($value['correct_answer'])){
    						$insert->answer = $value['correct_answer'];
    					}
    					

    					$insert->save();
    				}

    				 return response()->json([
	                    'status' => true,
	                    'msg'    => 'Questions added to question bank successfully'
	                ]); 

    			}else{
    				 return response()->json([
	                    'status' => false,
	                    'msg'    => 'Questions error'
	                ]);
    			}
    		}


    	}catch(Exception $e) {

            ErrorLog::log($e->getMessage(), 'error', __METHOD__);
            	return response()->json([
	                    'status' => false,
	                    'msg'    => $e->getMessage()
	                ]);
        }
    }
}
