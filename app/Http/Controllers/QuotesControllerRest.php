<?php 

namespace App\Http\Controllers;
use Validator;
use App\Http\Controllers\Controller;
use App\Models\Quote;
use Illuminate\Http\Request;

class QuotesControllerRest extends Controller{

	private function getIdList(){
		$idList = Quote::lists('id');
		return $idList;
	}

	private function getRandomId($except = null){
		$idList = collect($this->getIdList());
		if($except){
			$idList->push($except);
		}
		
		return collect($idList)->random();
	}

	private function getRandomQuote($except = null){
		$id = $this->getRandomId($except);
		$quote = Quote::findOrFail($id);

	    if (empty($quote)) {
	        $quote = new Quote();
	        $quote->author = 'Guracle';
	        $quote->text = 'Sorry dude, there are no quotes :(';
	    }

	    return $quote;
	}


	public function save(Request $request){
		$validator = Validator::make($request->all(), [
            'author' => 'required',
            'text' => 'required|max:140|min:3',
	    ]);

	    if ($validator->fails()) {
	            return redirect()->back()->withErrors($validator->errors());
	    }

	    $quote = new Quote;
	    $quote->author = $request->author;
	    $quote->text = $request->text;
	    $quote->save();
	    return randomize($id);
	}

	public function up($id){
		$quote = Quote::find($id);
		$quote->score += 1;
		$quote->save();
		$response = [
			'code' => 201,
			'status' => 'success',
			'message' => 'Vote computed, Thanks!'
		];
		return response()->json($response, $response['code']);
	}

	public function down($id){
		$quote = Quote::find($id);
		$quote->score -= 1;
		$quote->save();
		$response = [
			'code' => 201,
			'status' => 'success',
			'message' => 'Vote computed, Thanks!'
		];
		return response()->json($response, $response['code']);	
	}

	public function randomize($id = null){
		$quote = $this->getRandomQuote($id);

		return $quote;
	}
}