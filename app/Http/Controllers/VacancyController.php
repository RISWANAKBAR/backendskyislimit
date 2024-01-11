<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vacancy;
use Illuminate\Support\Facades\Validator;

class VacancyController extends Controller
{
    public function index()
    {
        // Retrieve all vacancies
        $vacancies = Vacancy::all();
        return response()->json($vacancies);
    }
    public function get($id)
    {
        
        $vacancy = Vacancy::find($id);
    
        if (!$vacancy) {
            return response()->json(['error' => 'Vacancy not found'], 404);
        }
    
        return response()->json($vacancy);
    }
    public function store(Request $request)
    { $validator = Validator::make($request->all(), [
        'job_id' => 'required|exists:jobs,id',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
        'description' => 'required|string',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 422);
    }

    $vacancy = new Vacancy();
    $vacancy->job_id = $request->input('job_id');
    $vacancy->start_date = $request->input('start_date');
    $vacancy->end_date = $request->input('end_date');
    $vacancy->description = $request->input('description');
    // Set any other fields as needed
    $vacancy->save();
    $users = User::where('status', 'active')->get(); 
    Mail::to($users)->send(new NewVacancyCreatedMail($vacancy));
    return response()->json($vacancy, 201);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'job_id' => 'exists:jobs,id',
            'start_date' => 'date',
            'end_date' => 'date|after_or_equal:start_date',
            'description' => 'string',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
    
        $vacancy = Vacancy::findOrFail($id);
    
      
        $vacancy->fill($request->all());
        $vacancy->save();
    
        return response()->json($vacancy, 200);
    }
    

 public function destroy($id)
{
    $vacancy = Vacancy::findOrFail($id);
    $vacancy->status = 'inactive'; 
    $vacancy->save();

    return response()->json(null, 204);
}

}
