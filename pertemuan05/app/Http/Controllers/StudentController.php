<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function index()
    {
        // echo "Menampilkan data animals";
        $studentData = Student::get();
        return response()->json($studentData, 200);
    }
    
    public function store(Request $request)
    {
        $studentData = [
            'nama' => $request->nama,
            'nim' => $request->nim,
            'email' => $request->email,
            'jurusan' => $request->jurusan,
        ];
        
        Student::create($studentData);
        
        return response()->json($message,201);
    }
    
    public function update(Request $request, $id)
    {
        try {
            $studentData = Student::findOrFail($id);
            $studentData->nama = $request->nama;
            $studentData->nim = $request->nim;
            $studentData->email = $request->email;
            $studentData->jurusan = $request->jurusan;
            $studentData->save();
            
            $message = [
                'message' => 'Data berhasil diubah',
                'data' => $studentData
            ];
            return response()->json($message,200);
        } catch (\Throwable $th) {
            return response()->json("Data Gagal diubah, cek kembali id atau inputan yang dimasukan",404);
        }
    }
    
    public function destroy($id)
    {
        try {
            $studentData = Student::findOrFail($id);
            $studentData->delete();
            
            $message = [
                'message' => 'Data berhasil dihapus',
                'data' => $studentData
            ];
            return response()->json($message,200);
        } catch (\Throwable $th) {
            return response()->json("Data Gagal dihapus",404);
        }
    }
}
