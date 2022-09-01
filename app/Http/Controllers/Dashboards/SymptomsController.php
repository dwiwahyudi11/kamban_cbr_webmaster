<?php

namespace App\Http\Controllers\Dashboards;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Symptoms;

use DataTables;
use Form;

class SymptomsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            $data = Symptoms::select(['id', 'nama_gejala', 'bobot']);

            return DataTables::of($data)
                            ->addIndexColumn()
                            ->addColumn('action', function($item) {
                                $button = '<div class="btn-toolbar" role="toolbar">
                                            <div class="btn-group mr-2" role="group">';
                                    $button .= '<a class="btn btn-primary" href="'. route('dashboard.symptoms.edit', $item->id) .'">Edit</a>';
                                $button .= '</div>';
                                
                                $button .= '<div class="btn-group">';
                                    $button .= Form::button('Delete', ['id' => 'button-delete-'. $item->id, 'class' => 'btn btn-danger', 'data-route' => route('dashboard.symptoms.destroy', $item->id) , 'onclick' => 'delete_data('. $item->id .')']);
                                $button .= '</div>';

                                $button .= '</div>';
                                return $button;
                            })
                            ->escapeColumns(['action'])
                            ->toJson();
        }

        return view('dashboards.symptoms.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = null;

        return view('dashboards.symptoms.form', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_gejala' => 'required|string|min:3|max:255',
            'deskripsi' => '',
            'bobot' => 'required'
        ]);

        $input = $request->all();

        $data = Symptoms::create($input);

        return redirect()->route('dashboard.symptoms.index')
                        ->with('success', 'Data gejala berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Symptoms::findOrFail($id);

        return view('dashboards.symptoms.form', compact('data'));
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
        $this->validate($request, [
            'nama_gejala' => 'required|string|min:3|max:255',
            'deskripsi' => '',
            'bobot' => 'required'
        ]);

        $input = $request->all();

        $data = Symptoms::findOrFail($id);
        $data->update($input);

        return redirect()->route('dashboard.symptoms.index')
                        ->with('success', 'Data gejala berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Symptoms::findOrFail($id);
        $data->delete();
        return response()->json(['status' => true, 'message' => 'Data gejala berhasil dihapus']);
    }
}
