<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    
    public function index()
    {
        # method index - get all resources
        $students = Student::get();
        if (!($students)) {
            $data = [
                'message' => 'Get all students',
                'data' => $students,
            ];
            
            return response()->json($data, 200);
        } else {
            return response()->json(['message' => 'Data tidak ditemukan'], 200);
        }
    }

    # menambahkan resource student
    # membuat method store
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nim' => 'required',
            'email' => 'required',
            'jurusan' => 'required',
        ]); 
        # menangkap data request
        $input = [
            'nama' => $request->nama,
            'nim' => $request->nim,
            'email' => $request->email,
            'jurusan' => $request->jurusan,
        ];
        
        # menggunakan Student untuk insert data
        $student = Student::create($input);
        
        $data = [
            'message' => 'Student created successfully',
            'data' => $student,
        ];
        
        # mengembalikan data (json) status code 201
        return response()->json($data, 201); 
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'nim' => 'required',
            'email' => 'required',
            'jurusan' => 'required',
        ]);

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
            return response()->json(['message' => 'Data tidak ditemukan'],404);
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
            return response()->json(['message' => 'Data tidak ditemukan'],404);
        }
    }

    function view($id)
    {
        try {
            $student = Student::findOrFail($id);

            $data = [
                'message' => 'Get a student data',
                'data' => $student,
            ];

            return response()->json($data, 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Data tidak ditemukan'],404);
        }
        
    }
}
