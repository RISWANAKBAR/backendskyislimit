<?php

namespace App\Http\Controllers;
use App\Models\ScheduledVacancy;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ScheduledVacancyController extends Controller
{
    public function index()
    {
        $scheduledVacancies = ScheduledVacancy::all();
        return response()->json($scheduledVacancies);
    }
    public function get($id)
    {
        // Retrieve a single vacancy by ID
        $vacancy =ScheduledVacancy::find($id);
    
        if (!$vacancy) {
            return response()->json(['error' => 'Vacancy not found'], 404);
        }
    
        return response()->json($vacancy);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'vacancy_id' => 'required|exists:vacancies,id',
            'user_id' => 'required|exists:users,id',
            'status' => 'nullable|in:scheduled,cancelled',
          
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
    
       
        $scheduledVacancy = ScheduledVacancy::create([
            'vacancy_id' => $request->input('vacancy_id'),
            'user_id' => $request->input('user_id'),
            'status' => $request->input('status', 'scheduled'),
           
        ]);
    
        return response()->json($scheduledVacancy, 201);
    }

public function update(Request $request, $id)
{
    $data = $request->validate([
        'vacancy_id' => 'exists:vacancies,id',
        'user_id' => 'exists:users,id',
        'status' => 'nullable|in:scheduled,cancelled'
       
    ]);

    $scheduledVacancy = ScheduledVacancy::findOrFail($id);
    $scheduledVacancy->update($data);
    return response()->json($scheduledVacancy, 200);
}
public function destroy($id)
{
    $scheduledVacancy = ScheduledVacancy::findOrFail($id);
    $scheduledVacancy->delete();
    return response()->json(null, 204);
}
public function deletePastScheduledVacancies()
{
    $pastScheduledVacancies = ScheduledVacancy::whereDate('end_date', '<', now())->get();
    foreach ($pastScheduledVacancies as $vacancy) {
        $vacancy->delete();
    }
    return response()->json('Past scheduled vacancies deleted', 200);
}

    
}
