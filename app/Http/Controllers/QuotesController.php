<?php 

namespace App\Http\Controllers;
use Validator;
use App\Http\Controllers\Controller;
use App\Models\Quote;
use Illuminate\Http\Request;

class QuotesController extends Controller{

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
	    $count = Quote::query()->get()->count();
	    $page = rand(1,$count);

	    $quotes = Quote::query()->get()->forPage($page, 1)->all();

	    if (empty($quotes)) {
	        throw new \Illuminate\Database\Eloquent\ModelNotFoundException();
	    }

	    return view('quote', ['quote' => $quotes[0]]);
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
}