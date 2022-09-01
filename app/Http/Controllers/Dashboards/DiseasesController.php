<?php

namespace App\Http\Controllers\Dashboards;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\CaseStudies;
use App\Diseases;
use App\Symptoms;

use DataTables;
use Form;

class DiseasesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            $data = Diseases::select(['id', 'nama_penyakit'])
                            ->withCount(['caseStudies']);

            return DataTables::of($data)
                            ->addIndexColumn()
                            ->addColumn('action', function($item) {
                                $button = '<div class="btn-toolbar" role="toolbar">
                                            <div class="btn-group mr-2" role="group">';
                                    $button .= '<a class="btn btn-primary" href="'. route('dashboard.diseases.edit', $item->id) .'">Edit</a>';
                                $button .= '</div>';
                                
                                $button .= '<div class="btn-group">';
                                    $button .= Form::button('Delete', ['id' => 'button-delete-'. $item->id, 'class' => 'btn btn-danger', 'data-route' => route('dashboard.diseases.destroy', $item->id) , 'onclick' => 'delete_data('. $item->id .')']);
                                $button .= '</div>';

                                $button .= '</div>';
                                return $button;
                            })
                            ->escapeColumns(['action'])
                            ->toJson();
        }

        return view('dashboards.diseases.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = null;
        $symptoms = Symptoms::orderBy('nama_gejala', 'asc')
                            ->get();

        $optionsSymptoms = $symptoms->pluck('nama_gejala', 'id');
        $dataSymptoms = [];
        $dataSymptoms[] = [
            'id' => '',
            'text' => ''
        ];
        foreach ($symptoms as $item) {
            $dataSymptoms[] = [
                'id' => $item->id,
                'text' => $item->nama_gejala
            ];
        }

        // dd($optionsSymptoms); exit;

        return view('dashboards.diseases.form', compact('data', 'optionsSymptoms', 'dataSymptoms'));
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
            'nama_penyakit' => 'required|string|min:3|max:255'
        ]);

        $input = $request->all();

        $slugName = Str::slug(Str::words($request->nama_penyakit, 3, ''));
        if($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $newFileName = $slugName .'.'. $image->getClientOriginalExtension();
            $request->file('gambar')->move(public_path('uploads/diseases/'), $newFileName);

            $input['gambar'] = $newFileName;
        }

        $data = Diseases::create($input);

        $caseStudies = $request->get('case_studies');
        foreach($caseStudies as $case) {
            if ($case) {
                CaseStudies::create([
                    'diseases_id' => $data->id,
                    'symptoms_id' => $case
                ]);
            }
        }

        return redirect()->route('dashboard.diseases.edit', $data->id)
                        ->with('success', 'Data penyakit berhasil ditambah');
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
        $data = Diseases::with(['caseStudies'])
                        ->findOrFail($id);

        $symptoms = Symptoms::orderBy('nama_gejala', 'asc')
                            ->get();

        $optionsSymptoms = $symptoms->pluck('nama_gejala', 'id');
        $dataSymptoms = [];
        $dataSymptoms[] = [
            'id' => '',
            'text' => ''
        ];
        foreach ($symptoms as $item) {
            $dataSymptoms[] = [
                'id' => $item->id,
                'text' => $item->nama_gejala
            ];
        }

        // xdebug_var_dump($data->toArray()); exit;

        return view('dashboards.diseases.form', compact('data', 'optionsSymptoms', 'dataSymptoms'));
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
            'nama_penyakit' => 'required|string|min:3|max:255'
        ]);

        $data = Diseases::findOrFail($id);

        $input = $request->all();

        // xdebug_var_dump($input); exit;

        $caseStudiesId = $request->get('case_studies_id');
        $caseStudies = $request->get('case_studies');
        $caseDeleted = $request->get('deleted_case');

        foreach ($caseDeleted as $index => $delete) {
            CaseStudies::find($delete)->delete();
        }

        foreach($caseStudies as $index => $case) {
            if ($case) {
                if (isset($caseStudiesId[$index])) {
                    $id = $caseStudiesId[$index];
                    $updateCase = CaseStudies::find($id);
                    if ($updateCase) {
                        $updateCase->update(['symptoms_id' => $case]);
                    }
                } else {
                    CaseStudies::create([
                        'diseases_id' => $data->id,
                        'symptoms_id' => $case
                    ]);
                }
            }
        }

        $slugName = Str::slug(Str::words($request->nama_penyakit, 3, ''));
        if($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $newFileName = $slugName .'.'. $image->getClientOriginalExtension();
            $request->file('gambar')->move(public_path('uploads/diseases/'), $newFileName);

            $input['gambar'] = $newFileName;
        }

        $data->update($input);

        return redirect()->route('dashboard.diseases.index')
                        ->with('success', 'Data penyakit berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Diseases::findOrFail($id);
        $data->delete();
        return response()->json(['status' => true, 'message' => 'Data penyakit berhasil dihapus']);
    }
}
