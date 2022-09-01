<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Carbon\Carbon;

use App\CaseStudies;
use App\Diseases;
use App\Symptoms;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        return view('home');
    }

    public function diseases(Request $request, $id)
    {
        $disease = Diseases::with(['caseStudies.symptom'])
                            ->findOrFail($id);

        // xdebug_var_dump($disease->toArray()); exit;

        return view('diseases', compact('disease'));
    }

    public function konsultasi(Request $request)
    {
        $symptoms = Symptoms::orderBy('nama_gejala', 'asc')->get();

        return view('konsultasi', compact('symptoms'));
    }

    public function konsultasiProcess(Request $request)
    {
        $input = $request->all();

        $validated = $request->validate([
            'symptoms' => 'required|array|min:1',
        ]);

        $idSymptoms = $request->get('symptoms');

        $symptoms = Symptoms::orderBy('nama_gejala', 'asc')
                                ->whereIn('id', $idSymptoms)
                                ->get();

        $cases = CaseStudies::select('diseases_id')
                            ->whereIn('symptoms_id', $idSymptoms)
                            ->groupBy('diseases_id')
                            ->with(['disease.caseStudies.symptom'])
                            ->get();

        // xdebug_var_dump($cases->toArray()); exit;
        $perhitungan = [];
        $tableData = [];
        $bobot = [];
        $totalBobot = 0;
        foreach ($symptoms as $index => $item) {
            $newItem = [
                'id' => $item->id,
                'nama_gejala' => $item->nama_gejala,
                'bobot' => $item->bobot,
                'diseases' => []
            ];
            $bobot[] = $item->bobot;
            $totalBobot+= $item->bobot;

            foreach($cases as $case) {
                $caseStudies = $case->disease->caseStudies->pluck('symptoms_id')->toArray();
                $similiar = in_array($item->id, $caseStudies) ? 1 : 0;
                $total_similiar = $similiar * $item->bobot;

                $newItem['diseases'][] = [
                    'id' => $case->disease->id,
                    'nama_penyakit' => $case->disease->nama_penyakit,
                    'similiar' => $similiar,
                    'total_similiar' => $total_similiar
                ];

                if (! isset($perhitungan[$case->disease->id])) {
                    $perhitungan[$case->disease->id] = [
                        'id' => $case->disease->id,
                        'nama_penyakit' => $case->disease->nama_penyakit,
                        'text_similiar' => [
                            '('. $similiar .'x'. $item->bobot .')'
                        ],
                        'text_total_similiar' => [
                            $total_similiar
                        ],
                        'total_similiar' => 0,
                        'total_perhitungan' => 0,
                    ];
                } else {
                    $perhitungan[$case->disease->id]['text_similiar'][] = '('. $similiar .'x'. $item->bobot .')';
                    $perhitungan[$case->disease->id]['text_total_similiar'][] = $total_similiar;
                }
            }
            $tableData[$index] = $newItem;
        }

        foreach($tableData as $index => $item) {
            foreach($item['diseases'] as $disease) {
                if (isset($perhitungan[$disease['id']])) {
                    // $perhitungan[$disease['id']]['text_total_similiar'] .= '()';
                    $perhitungan[$disease['id']]['total_bobot'] = $totalBobot; 
                    $perhitungan[$disease['id']]['total_similiar'] += $disease['total_similiar'];
                }
            }
        }
        foreach($perhitungan as $key => $item) {
            $perhitungan[$key]['total_perhitungan'] = round($item['total_similiar']/$totalBobot, 3);
        }

        $rumus = [
            'bobot' => $bobot,
            'perhitungan' => $perhitungan,
            'table_data' => $tableData,
        ];

        $results = collect($perhitungan)->sortByDesc('total_perhitungan')->values()->all();
        // xdebug_var_dump($results); exit;

        return view('analisa', compact('input', 'symptoms', 'cases', 'rumus', 'results'));
    }

    
}
