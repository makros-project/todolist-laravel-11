<?php

namespace App\Http\Controllers\Todo;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $max_data = 5;
        if(request('search')){
            $data = DB::table('todo')
            ->where('task', 'like', '%' . request('search') . '%')
            ->paginate($max_data);
                } else {
            $data = DB::table('todo')->paginate($max_data);
        }
        
        // $data = DB::select('SELECT * FROM todo ');
        return view('todo.app',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // membuat validasi minimal 3 huruf dan maksimal 10 huruf
        $request->validate([
            'task' => 'required|min:3|max:10'
        ],
        // membuat alert dari peringatan error
        [
            'task.required' => 'Wajib Diisi',
            'task.min' => 'Wajib Diisi Minimal 3 Karakter',
            'task.max' => 'Wajib Diisi Maksimal 10 Karakter',
        ]);
        //membuat variable meniyimpan data did alam array
        $data = [
            'task' => $request->input('task')
        ];
        // /membuat perintah simpan data ke model Todo
            Todo::create($data);
            // membuat rediret pada routing dengan nama 'todo' dan memberi session success`
            return redirect()->route('todo')->with('success','Berhasil Simpan Data');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         // membuat validasi minimal 3 huruf dan maksimal 10 huruf
         $request->validate([
            'task' => 'required|min:3|max:10'
        ],
        // membuat alert dari peringatan error
        [
            'task.required' => 'Wajib Diisi',
            'task.min' => 'Wajib Diisi Minimal 3 Karakter',
            'task.max' => 'Wajib Diisi Maksimal 10 Karakter',
        ]);

         //membuat variable meniyimpan data did alam array
         $data = [
            'task' => $request->input('task'),
            'is_done' => $request->input('is_done')
        ];

        // membuat sql raw untuk update dengan cara begini
        $data = DB::statement("UPDATE todo SET 
        task = ?, 
        is_done = ? 
        WHERE id = ?", [
            $request->input('task'), 
            $request->input('is_done'), // Pastikan ini benar jika field-nya adalah is_done
            $id
        ]);

        // Todo::where('id', $id)->update();
        return redirect()->route('todo')->with('success','Berhasil Mengubah Data');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // membuat sql raw untuk update dengan cara begini
        DB::statement("DELETE FROM todo WHERE id = ?", [$id]);
        return redirect()->route('todo')->with('success','Berhasil Menghapus Data');

    }
}
