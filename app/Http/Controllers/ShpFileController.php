<?php

namespace App\Http\Controllers;

use Exception;
use ZipArchive;
use JsonMachine\Items;
use App\Models\ShpFile;
use Illuminate\Http\Request;
use Shapefile\ShapefileReader;
use Shapefile\ShapefileException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use App\Http\Controllers\Admin\UtilityController;

class ShpFileController extends Controller
{
    public function index() {
        $data = ShpFile::orderBy('is_regional', 'desc')->orderBy('is_shown', 'desc')->orderBy('id')->get();
        return view ('admin.shpfile.index', [
            'page_title' => trans('Pengaturan'),
            'page_title2' => trans('Manajemen Data Spasial'),
            'breadcrumb' => trans('Pengaturan'),
            'active' => 'shpfile',
            'data' => $data,
        ]);
    }

    public function detail($id) {
        $created_at = str_replace(' ', '_', trans('Diproses Pada'));
        $avail_fields = str_replace(' ', '_', trans('Kolom Tersedia'));
        $sel_fields = str_replace(' ', '_', trans('Kolom Terpilih'));
        $data = ShpFile::where('id', $id)->selectRaw("created_at AS " . $created_at . ", Replace(available_fields,',',', ') AS " . $avail_fields . ", Replace(selected_fields,',',', ') AS " . $sel_fields)->first();
        return response()->json([
            'data' => $data,
        ]);
    }
    
    public function add() {
        return view ('admin.shpfile.add', [
            'page_title' => trans('Pengaturan'),
            'page_title2' => trans('Unggah Data Spasial').' - '.trans('Akses Lahan'),
            'breadcrumb' => trans('Pengaturan'),
            'active' => 'shpfile',
        ]);
    }

    public function store(Request $request) {
        $destinationPath = 'shp-files';
        $fileshp = $request->file('shp_file');
        $fileshx = $request->file('shx_file');
        $filedbf = $request->file('dbf_file');
        $fileshpname = strtolower($fileshp->getClientOriginalName());
        $fileshxname = strtolower($fileshx->getClientOriginalName());
        $filedbfname = strtolower($filedbf->getClientOriginalName());
        $fileshpname_split = explode('.', $fileshpname);
        $table_name = str_replace('-', '_', str_replace(' ', '_', $fileshpname_split[0]));

        if (Schema::hasTable($table_name)) {
            return redirect()->back()->with('errorMsg', trans('Tabel spasial sudah ada'));
        }

        $fileshp->move($destinationPath, $fileshpname);
        $fileshx->move($destinationPath, $fileshxname);
        $filedbf->move($destinationPath, $filedbfname);

        try {
            $Shapefile = new ShapefileReader($destinationPath . "/" . $fileshpname);
            $queryCreate = "";
            $queryIndex = "CREATE INDEX " . $table_name . "_geom_idx ON " . $table_name . " USING gist(geom)";
            $queryInsert = "INSERT INTO " . $table_name . " (#lstCols#) VALUES ";
            $lstQryInsert = "";
            $lstCols = "";

            while ($Geometry = $Shapefile->fetchRecord()) {
                if ($Geometry->isDeleted()) continue;
                $wkt = $Geometry->getWKT();
                $dataArray = $Geometry->getDataArray();

                if (!strlen($queryCreate) && !strlen($lstCols)) {
                    $queryCreate = "CREATE TABLE IF NOT EXISTS " . $table_name . " (idd serial,geom geometry";
                    $lstCols = "";
                    foreach ($dataArray as $key => $val) {
                        if (floatval($val) == $val) $queryCreate .= "," . strtolower($key) . " float8";
                            else $queryCreate .= "," . strtolower($key) . " varchar";
                        $lstCols .= (strlen($lstCols) ? "," : "") . strtolower($key);
                    }
                    $queryCreate .= ", primary key(idd));";
                }
                $lstQryInsert .= (strlen($lstQryInsert) ? "," : "") . "('" . $wkt . "'";
                foreach ($dataArray as $key => $val) {
                    if (floatval($val) == $val) $lstQryInsert .= "," . floatval($val);
                    else if (strpos($val, "'")>-1) $lstQryInsert .= ",'" . str_replace("'", "''", $val) . "'";
                    else $lstQryInsert .= ",'" . $val . "'";
                }
                $lstQryInsert .= ")";
            }
            $queryInsert = str_replace('#lstCols#', "geom," . $lstCols, $queryInsert) . $lstQryInsert;
            try {
                DB::statement($queryCreate);
                DB::statement($queryIndex);
                DB::statement($queryInsert);
                $data['shp_filename'] = $fileshpname;
                $data['table_name'] = $table_name;
                $data['available_fields'] = $lstCols;
                $data['source'] = 'upload';
                $data['is_shown'] = 'no';
                $data['is_regional'] = 'no';
                $data['created_by'] = Auth::user()->username;
                $data['modified_by'] = Auth::user()->username;
                ShpFile::create($data);
                return redirect('/admin/shpfile')->with('successMsg', trans('Berhasil mengunggah file SHP'));
            } catch (Exception $e) {
                var_dump($e);
            }
        } catch (ShapefileException $e) {
            echo "Error Type: " . $e->getErrorType()
                . "\nMessage: " . $e->getMessage()
                . "\nDetails: " . $e->getDetails() . "<br>";
            var_dump($e);
        }
    }

    public function storezip(Request $request) {
        $util = new UtilityController();
        $destinationPath = 'shp-files';
        $filezip = $request->file('zip_file');
        $filename = strtolower($filezip->getClientOriginalName());
        $filename_split = explode('.', $filename);
        $table_name = str_replace('-', '_', str_replace(' ', '_', $filename_split[0]));
        if (Schema::hasTable($table_name)) {
            return redirect()->back()->with('errorMsg', trans('Tabel spasial sudah ada'));
        }
        $filezip->move($destinationPath, $filename);
        try {
            $zip = new ZipArchive();
            $zipOpen = $zip->open($destinationPath.'/'.$filename);
            if ($zipOpen === true) {
                $zip->extractTo($destinationPath.'/temp_extract');
                $files = scandir($destinationPath.'/temp_extract');
                $fileshp = glob($destinationPath.'/temp_extract/*.shp');
                $fileshx = glob($destinationPath.'/temp_extract/*.shx');
                $filedbf = glob($destinationPath.'/temp_extract/*.dbf');
                if (!count($fileshp) || !count($fileshx) || !count($filedbf)) {
                    $util->removeTempFiles($destinationPath.'/temp_extract');
                    return redirect()->back()->with('errorMsg', trans('File ZIP tidak sesuai dengan format yang diminta'));
                }
                try {
                    $Shapefile = new ShapefileReader($fileshp[0]);
                    $queryCreate = "";
                    $queryIndex = "CREATE INDEX " . $table_name . "_geom_idx ON " . $table_name . " USING gist(geom)";
                    $queryInsert = "INSERT INTO " . $table_name . " (#lstCols#) VALUES ";
                    $lstQryInsert = "";
                    $lstCols = "";
                    while($Geometry = $Shapefile->fetchRecord()) {
                        if ($Geometry->isDeleted()) continue;
                        $wkt = $Geometry->getWKT();
                        $dataArray = $Geometry->getDataArray();
                        if (!strlen($queryCreate) && !strlen($lstCols)) {
                            $queryCreate = "CREATE TABLE IF NOT EXISTS " . $table_name . " (id serial,geom geometry";
                            $lstCols = "";
                            foreach ($dataArray as $key => $val) {
                                if (floatval($val) == $val) $queryCreate .= "," . strtolower($key) . " float8";
                                    else $queryCreate .= "," . strtolower($key) . " varchar";
                                $lstCols .= (strlen($lstCols) ? "," : "") . strtolower($key);
                            }
                            $queryCreate .= ", primary key(id));";
                        }
                        $lstQryInsert .= (strlen($lstQryInsert) ? "," : "") . "('" . $wkt . "'";
                        foreach ($dataArray as $key => $val) {
                            if (floatval($val) == $val) $lstQryInsert .= "," . floatval($val);
                            else if (strpos($val, "'")>-1) $lstQryInsert .= ",'" . str_replace("'", "''", $val) . "'";
                            else $lstQryInsert .= ",'" . $val . "'";
                        }
                        $lstQryInsert .= ")";        
                    }
                    $queryInsert = str_replace('#lstCols#', "geom," . $lstCols, $queryInsert) . $lstQryInsert;
                    try {
                        DB::statement($queryCreate);
                        DB::statement($queryIndex);
                        DB::statement($queryInsert);
                        $data['shp_filename'] = $filename;
                        $data['table_name'] = $table_name;
                        $data['available_fields'] = $lstCols;
                        $data['source'] = 'upload';
                        $data['is_shown'] = 'no';
                        $data['is_regional'] = 'no';
                        $data['created_by'] = Auth::user()->username;
                        $data['modified_by'] = Auth::user()->username;
                        ShpFile::create($data);
                        $Shapefile = null;
                        $util->removeTempFiles($destinationPath.'/temp_extract');
                        return redirect('/admin/shpfile')->with('successMsg', trans('Berhasil mengunggah file SHP'));
                    } catch (Exception $e) {
                        dd($e);
                    }        
                } catch (ShapefileException $e) {
                    echo "Error Type: " . $e->getErrorType()
                    . "\nMessage: " . $e->getMessage()
                    . "\nDetails: " . $e->getDetails() . "<br>";
                }
            } else {
                return redirect()->back()->with('errorMsg', trans('File ZIP tidak sesuai dengan format yang diminta'));
            }
        } catch (Exception $e) {
            dd($e);
        }
    }

    public function edit($id) {
        return view('admin.shpfile.edit', [
            'page_title' => trans('Pengaturan'),
            'page_title2' => trans('Edit Data Spasial'),
            'breadcrumb' => trans('Pengaturan'),
            'data' => ShpFile::find($id),
            'active' => 'shpfile'
        ]);
    }

    public function update(Request $request, $id) {
        $sel_fields = [];
        if ($request->sel_fields) {
            foreach ($request->sel_fields as $s) {
                array_push($sel_fields, $s);
            }
        }
        $data['selected_fields'] = implode(",", $sel_fields);
        $data['is_regional'] = ($request->is_regional ? "yes" : "no");
        $data['is_shown'] = ($request->is_shown ? "yes" : "no");
        $data['modified_by'] = Auth::user()->username;
        ShpFile::find($id)->update($data);
        return redirect('/admin/shpfile')->with('successMsg', trans('Berhasil mengubah data spasial'));
    }

    public function preview($id) {
        $data = ShpFile::find($id);
        return view('admin.shpfile.preview', [
            'id' => $id,
            'data' => $data
        ]);
    }

    public function previewone($id) {
        $data = ShpFile::find($id);
        $id_reg = DB::table($data->table_name)
            ->select(['idd','nmprov','nmkab','nmkec','nmdesa'])
            ->where('skema_ps', '<>', 'Tidak direkomendasi PS')
            ->orderByRaw('nmprov ASC, nmkab ASC, nmkec ASC, nmdesa ASC')
            ->get();
        return view('admin.shpfile.previewone', [
            'id' => $id,
            'data' => $data,
            'id_reg' => $id_reg
        ]);
    }

    public function loadshp($id, $param = "") {
        try{
            $data = ShpFile::find($id);
            $fields = 'idd,ST_AsGeoJSON(geom) AS geom,' . $data->available_fields;
            if ($param) {
                $where = base64_decode($param);
                if (strpos($where, 'daerah') > -1) {
                    $wherea = explode(' AND ', $where);
                    array_shift($wherea);
                    $where = implode(' AND ', $wherea);
                }
            } else $where = "1=1";
            $shp = DB::table(strtolower($data->table_name))->whereRaw($where)->selectRaw($fields)->get();
            foreach ($shp as $s) {
                $props = array();
                $props['idd'] = $s->idd;
                foreach (explode(',', $data->available_fields) as $f) {
                    $props[$f] = $s->$f;
                }

                $item = Items::fromString($s->geom);
                $geom = array();
                foreach ($item as $key => $val) {
                    $geom[$key] = $val;
                }
                $features[] = array(
                    'type' => 'Feature',
                    'geometry' => $geom,
                    'properties' => $props
                );
            }
            $allfeature = array('type' => 'FeatureCollection', 'features' => $features);
            return response()->json($allfeature);
        } catch (Exception $e) {
            dd($e);
        }
    }

    public function loadshp2($id, $input = '') {
        $shp = ShpFile::find($id);
        if ($input) {
            $input = json_decode(base64_decode($input));
            $fields = 'idd,ST_AsGeoJSON(geom) AS geom,' . $shp->available_fields;
            $data = DB::table($shp->table_name)->whereRaw("st_intersects(st_setsrid(".$shp->table_name.".geom, 4326), st_setsrid(st_geomfromgeojson('".json_encode($input->geometry)."'), 4326))")->selectRaw($fields)->get();
            foreach ($data as $d) {
                $props = array();
                $props['idd'] = $d->idd;
                foreach (explode(',', $shp->available_fields) as $f) {
                    $props[$f] = $d->$f;
                }
                $features[] = array(
                    'type' => 'Feature',
                    'geometry' => json_decode($d->geom),
                    'properties' => $props
                );
            }
            if (isset($features))
                $allfeature = array('type' => 'FeatureCollection', 'features' => $features);
            else
                $allfeature = array();
            return response()->json($allfeature);
        }
    }

    public function loadshpregion($id, $idd) {
        $shp = ShpFile::find($id);
        if ($idd) {
            $idd = base64_decode($idd);
            $fields = 'ST_AsGeoJSON(geom) AS geom,' . $shp->available_fields;
            $data = DB::table($shp->table_name)->where("idd", $idd)->selectRaw($fields)->get();
            foreach ($data as $d) {
                $props = array();
                foreach (explode(',', $shp->available_fields) as $f) {
                    $props[$f] = $d->$f;
                }
                $features[] = array(
                    'type' => 'Feature',
                    'geometry' => json_decode($d->geom),
                    'properties' => $props
                );
            }
            if (isset($features))
                $allfeature = array('type' => 'FeatureCollection', 'features' => $features);
            else
                $allfeature = array();
            return response()->json($allfeature);
        }
    }

    public function getfields($table) {
        $fields = ShpFile::where('table_name', $table)->first()['available_fields'];
        return response()->json($fields);
    }

    public function getfieldvalue($table, $field) {
        $values = DB::table($table)->distinct()->orderBy($field)->get([$field]);
        return response()->json($values);
    }

    public function merge() {
        $data = ShpFile::get();
        return view ('admin.shpfile.merge', [
            'page_title' => trans('Pengaturan'),
            'page_title2' => trans('Gabungkan Data Spasial'),
            'breadcrumb' => trans('Pengaturan'),
            'active' => 'shpfile',
            'data' => $data
        ]);
    }

    public function domerge(Request $request) {
        $data1 = ShpFile::where('table_name', $request->sel_data1)->first();
        $data2 = ShpFile::where('table_name', $request->sel_data2)->first();
        $fields1 = explode(',', $data1->available_fields);
        $fields2 = explode(',', $data2->available_fields);
        $tablename1 = str_replace('_', '', $data1->table_name);
        $tablename2 = str_replace('_', '', $data2->table_name);
        if ($request->new_table) $new_table = $request->new_table;
            else $new_table = $tablename1 . "_" . $tablename2;

        if (Schema::hasTable($new_table)) {
            return redirect()->back()->with('errorMsg', trans('Tabel spasial sudah ada'));
        }        
        
        $queryCreate = "CREATE TABLE IF NOT EXISTS " . $new_table . " AS ";
        $lstFields1 = [];
        $lstFields2 = [];
        $lstFields = [];
        foreach ($fields1 as $f) {
            $f2 = explode('__', $f);
            if (count($f2) > 1) $f3 = $f2[1];
                else $f3 = $f2[0];
            if ($request["name_" . $tablename1 . "_" . $f3])
                $new_field = $request["name_" . $tablename1 . "_" . $f3];
            else $new_field = $tablename1 . "__" . $f3;
            array_push($lstFields1, $f . " AS " . $new_field);
            array_push($lstFields2, "null AS " . $new_field);
            array_push($lstFields, $new_field);
        }
        echo "<hr>";
        foreach ($fields2 as $f) {
            $f2 = explode('__', $f);
            if (count($f2) > 1) $f3 = $f2[1];
                else $f3 = $f2[0];
            if ($request["name_" . $tablename2 . "_" . $f3])
                $new_field = $request["name_" . $tablename2 . "_" . $f3];
            else $new_field = $tablename2 . "__" . $f3;
            array_push($lstFields1, "null AS " . $new_field);
            array_push($lstFields2, $f . " AS " . $new_field);
            array_push($lstFields, $new_field);
        }
        $queryCreate .= "(SELECT geom," . implode(',', $lstFields1) . " FROM " . $data1->table_name . ") UNION (SELECT geom," . implode(',', $lstFields2) . " FROM " . $data2->table_name . ");";
        try {
            DB::statement($queryCreate);
            $data['shp_filename'] = '';
            $data['table_name'] = $new_table;
            $data['available_fields'] = implode(',', $lstFields);
            $data['source'] = 'merge';
            $data['is_shown'] = 'no';
            $data['is_regional'] = 'no';
            $data['created_by'] = Auth::user()->username;
            $data['modified_by'] = Auth::user()->username;
            ShpFile::create($data);
            return redirect('/admin/shpfile')->with('successMsg', trans('Berhasil menggabungkan data spasial'));
    } catch (Exception $e) {
            var_dump($e);
        }
    }

    public function destroy($id) {
        $data = ShpFile::find($id);
        $qDelTable = "DROP TABLE IF EXISTS " . $data->table_name;
        try {
            DB::statement($qDelTable);
            ShpFile::destroy($id);
            return redirect('/admin/shpfile')->with('successMsg', trans('Berhasil menghapus data spasial'));
        } catch (Exception $e) {
            var_dump($e);
        }
    }
}
