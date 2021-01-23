<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classroom;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource. (Archive)
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get data from DB
        // $classrooms = Classroom::all();
        // dd($classrooms);
        $classrooms = Classroom::paginate(4);
        
        // CARBON 
        // $dt = Carbon::now();
        // $dt = Carbon::yesterday();
        // dump($dt->toDateString());
        // dump($dt->format('d/m/Y'));

        //  Comparazione
        // $first = Carbon::create('2021/01/13');
        // $second = Carbon::create('2020/01/13');
        // dump( $first->lt($second) );

        // Differenza giorni
        // $from = Carbon::create('2021/01/13');
        // dump( $from->diffInDays() );
        // dump( $from->diffInDays('2021/02/13') );

        // $dt = Carbon::now()->locale('it_IT');
        // dump( $dt->locale() );
        // dump( $dt->isoFormat('dddd DD/MM/YYYY') );

        return view('classrooms.index', compact('classrooms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('classrooms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $data = $request->all();
        // dd($data);

        // VALIDATION
        $request->validate([
            'name' => 'required|unique:classrooms|max:10', 
            'description' => 'required'
        ]);

        // SAVE FROM DB
        $classroom = new Classroom();
        // $classroom->name = $data['name'];
        // $classroom->description = $data['description'];
        $classroom->fill($data); // <-- $fillable nel model

        $saved = $classroom->save();
        // dd($saved);

        if($saved) {
            return redirect()->route('classrooms.show', $classroom->id);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $id = $_GET['id'];
        // $obj = new Classroom();
        $classroom = Classroom::find($id);
        // dd($classroom);

       return view('classrooms.show', compact('classroom'));
    }

    // PARTE CRUD 2

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $classroom = Classroom::find($id);

        return view('classrooms.edit', compact('classroom'));
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
        // DATI INVIATI DALLA FORM
        $data = $request->all();

        // ISTANZA SPECIFICA
        $classroom = Classroom::find($id);

        // VALIDATION
        $request->validate([
            'name' => [
                'required',
                Rule::unique('classrooms')->ignore($id),
                'max:10'
            ], 
            'description' => 'required'
        ]);

        // AGGIORNARE DATI DB
        $updated = $classroom->update($data); // <-- $fillable nel model

        if($updated) {
            return redirect()->route('classrooms.show', $classroom->id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $classroom = Classroom::find($id);

        $ref = $classroom->name;
        $deleted = $classroom->delete();

        if($deleted) {
            return redirect()->route('classrooms.index')->with('deleted', $ref);
        }
    }
}
