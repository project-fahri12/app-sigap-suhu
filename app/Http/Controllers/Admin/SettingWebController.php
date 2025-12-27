<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SettingWebController extends Controller
{
    public function index()
    {
        $listTahunAjaran = DB::table('tahun_ajaran')->get(); 
        $listGelombang = DB::table('gelombang')->get();

        return view('admin.settingWeb.settingWeb', compact('listTahunAjaran', 'listGelombang'));
    }

    public function ajaxUpdate(Request $request)
    {
        try {
            $key = $request->setting_key;
            $value = $request->setting_value;

            // Handle Upload File
            if ($request->hasFile('setting_value')) {
                $file = $request->file('setting_value');
                $fileName = $key . '_' . time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('uploads/settings', $fileName, 'public');
                
                // Hapus file lama agar storage server tidak bengkak
                $old = DB::table('setting_web')->where('setting_key', $key)->first();
                if ($old && $old->setting_value && Storage::disk('public')->exists(str_replace('storage/', '', $old->setting_value))) {
                    Storage::disk('public')->delete(str_replace('storage/', '', $old->setting_value));
                }
                
                $value = 'storage/' . $path;
            }

            // Update menggunakan nama kolom setting_key & setting_value
            DB::table('setting_web')->updateOrInsert(
                ['setting_key' => $key],
                ['setting_value' => $value, 'updated_at' => now()]
            );

            return response()->json([
                'status' => 'success', 
                'new_value' => $request->hasFile('setting_value') ? asset($value) : $value 
            ]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
}