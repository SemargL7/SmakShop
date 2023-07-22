<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ItemReview;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        try{
            // Validate the form data
            $validatedData = $request->validate([
                'product_id' => 'required|integer',
                'feedback_stars' => 'required|integer',
                'name' => 'required|string',
                'email' => 'required|email',
                'feedback' => 'required|string',
            ]);

            // Create a new Feedback model instance and set the data
            $feedback = new ItemReview();
            $feedback->item_id = $validatedData['product_id'];
            $feedback->stars = $validatedData['feedback_stars'];
            $feedback->user_name = $validatedData['name'];
            $feedback->user_email = $validatedData['email'];
            $feedback->review = $validatedData['feedback'];

            // Save the feedback data to the database
            $feedback->save();

            // You can add any additional logic or redirect the user to another page after saving the data
            // For example:

            return redirect()->back();
        }catch (Exception $e){
            dd($e);
        }
         // Assuming you have a "thank you" page route
    }
}
