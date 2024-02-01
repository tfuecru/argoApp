<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artist;
use Illuminate\Support\Facades\DB;

class PaginateArtistController extends Controller {
    
   private $bladeFolder = 'paginateartist';
    const RPP = 10;
    const ORDERBY = 'id';
    const ORDERTYPE = 'asc';
    
    private function getBladeFolder(string $folder) {
        return $this->bladeFolder . '.' . $folder;
    }

    public function index(Request $request) {
        $rpp = self::getFromRequest($request, 'rowsPerPage', self::RPP);
        $orderby = self::getFromRequest($request, 'orderBy', self::ORDERBY);
        $ordertype = self::getFromRequest($request, 'orderType', self::ORDERTYPE);
        $q = self::getFromRequest($request, 'q', null);
        
        if( $q == null ) {
            $artists = Artist::orderBy($orderby, $ordertype)->orderBy('name', 'asc')->paginate($rpp);
        } else {
            $artists = Artist::where('name', 'like', '%' . $q . '%')
                        ->orWhere('id', $q)
                        ->orWhere('idoltro', 'like', '%' . $q . '%')
                        ->orWhere('idargo', 'like', '%' . $q . '%')
                        ->orderBy($orderby, $ordertype)
                        ->orderBy('name', 'asc')
                        ->paginate($rpp);
        }
        return view($this->getBladeFolder('index'),
            [
                'artists' => $artists,
                'orderBy' => $orderby,
                'orderType' => $ordertype,
                'q' => $q,
                'rpp' => $rpp,
                'rpps' => self::getRowsPerPage()
            ]);
    }
    
    private static function getFromRequest( $request, $name, $defaultValue ) {
        $value = $defaultValue;
         if($request->$name != null) {
            $value = $request->$name;
        }
        return $value;
    }
    
    public function index2(Request $request) {
        // 1º
        $rpp = self::RPP;
        if($request->rowsPerPage != null) {
            $rpp = $request->rowsPerPage;
        }
        
        // 2º
        $page = 1;
        if($request->page != null) {
            $page = $request->page;
        }
        
        // 3º 
        $calculo = $rpp * ($page - 1 );
        $sql = "select * from artist limit $calculo, $rpp";
        $artists = DB::select($sql);
        $total = DB::table('artist')->count();
        $pages = ceil($total / $rpp);
        return view($this->getBladeFolder('index2'),
            [
                'artists' => $artists,
                'pages' => $pages,
                'rpp' => $rpp,
                'rpps' => self::getRowsPerPage(),
                
            ]);
    }
    
    private static function getRowsPerPage() {
        return [
            3 => 3,
            10 => 10,
            25 => 25,
            50 => 50
        ];
    }
    
    public function create() {
        //
    }

    
    public function store(Request $request) {
        //
    }

    
    public function show($id) {
        //
    }

    
    public function edit($id) {
        //
    }

    
    public function update(Request $request, $id) {
        //
    }

    
    public function destroy($id) {
        //
    }
}
