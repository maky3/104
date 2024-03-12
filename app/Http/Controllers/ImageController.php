<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use ZipArchive as ZipArchiveAlias;

class ImageController extends Controller
{
    public function index()
    {
        $images = Image::orderBy('uploaded_at', 'desc')->paginate(10);
        return view('images.index', compact('images'));
    }

    public function uploadForm()
    {
        return view('images.upload');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'files.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasfile('files')) {
            foreach ($request->file('files') as $file) {
                $filename = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
                $filename = Str::lower($filename);

                // Проверка на уникальность имени файла
                while (Storage::exists('public/images/' . $filename)) {
                    $filename = uniqid() . '_' . $filename;
                }

                $path = $file->storeAs('public/images', $filename);

                Image::create([
                    'filename' => $filename,
                    'uploaded_at' => now(),
                ]);
            }
        }

        return redirect()->route('images.index')->with('success', 'Images uploaded successfully.');
    }

    public function show($id)
    {
        $image = Image::findOrFail($id);
        return view('images.show', compact('image'));
    }

    public function downloadZip($id)
    {
        $image = Image::findOrFail($id);
        $zip = new ZipArchiveAlias;
        $fileName = $image->filename . '.zip';

        if ($zip->open(storage_path('app/public/images/' . $fileName), ZipArchiveAlias::CREATE) === TRUE) {
            $files = File::files(storage_path('app/public/images'));

            foreach ($files as $key => $value) {
                $relativeNameInZipFile = basename($value);
                $zip->addFile($value, $relativeNameInZipFile);
            }

            $zip->close();
        }

        return response()->download(storage_path('app/public/images/' . $fileName));
    }

    public function apiIndex()
    {
        $images = Image::all();
        return response()->json($images);
    }

    public function apiShow($id)
    {
        $image = Image::findOrFail($id);
        return response()->json($image);
    }
}
