<?php 

namespace App\Http\Controllers;
use Validator;
use App\Http\Controllers\Controller;
use App\Models\Quote;
use Illuminate\Http\Request;

class QuotesController extends Controller{

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

	public function home(){
		/*
	     * Picks a different quote every day 
	     * (for a maximum of 366 quotes)
	     *
	     *   - $count: the total number of available quotes
	     *   - $day: the current day of the year (from 0 to 365)
	     *   - $page: the page to look for to retrieve the 
	     *            correct record
     	*/
	    $quote = $this->getRandomQuote();
	    return view('quote', ['quote' => $quote]);
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
	    return redirect()->route('home');
	}

	public function up($id){
		$quote = Quote::find($id);
		$quote->score += 1;
		$quote->save();
		return redirect()->back();
	}

	public function down($id){
		$quote = Quote::find($id);
		$quote->score -= 1;
		$quote->save();
		return redirect()->back();	
	}

	public function iframe(){
		$quote = $this->getRandomQuote();

	    return view('iframe', ['quote' => $quote]);
	}

	public function randomize($id){
		$quote = $this->getRandomQuote($id);
		return view('quote', ['quote' => $quote]);
	}
}