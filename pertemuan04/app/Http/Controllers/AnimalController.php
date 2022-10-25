<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnimalController extends Controller
{
    protected $animal = [
        [
            'id' => 1,
            'nama' => 'Kucing',
        ],
        [
            'id' => 2,
            'nama' => 'Ayam',
        ],
        [
            'id' => 3,
            'nama' => 'Ikan',
        ],
    ];

    public function index()
    {
        foreach($this->animal as $a){
            echo $a['nama'].", ";
        }
    }

    public function store(Request $request)
    {
        //check if id is exist
        foreach($this->animal as $a){
            if($a['id'] == $request->id){
                return 'Id sudah ada, gunakan id yang lain';
            }
        }
        
        array_push($this->animal,[
            'id' => $request->id,
            'nama' => $request->nama,
        ]);
        echo "Menambahkan data animals - ";
        echo "Nama hewan: $request->nama";
        echo "<br>";
        $this->index();
    }

    public function update(Request $request, $id)
    {
        $data = [
            'nama' => $request->nama,
        ];
        $this->animal[$id] = $data;

        echo "Mengubah data animal id $id - ";
        echo "Nama hewan: $request->nama";
        echo "<br>";
        $this->index();
    }

    public function destroy($id)
    {
        array_splice($this->animal,$id);
        echo "Menghapus data animal id $id";
        echo "<br>";
        $this->index();
    }
}
