<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Provider;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    /**
     * Show create service page
     */
    public function create()
    {
        // ambil provider user login
        $provider = Provider::where('user_id', Auth::id())->first();

        // kalau belum jadi provider
        if (!$provider) {
            return redirect('/become-provider')
                ->with('error', 'Anda harus menjadi penyedia terlebih dahulu.');
        }

        return view('seller-pages.services.create');
    }

    /**
     * Store new service
     */
    public function store(Request $request)
    {
        // validasi form
        $request->validate([
            'title' => 'required|min:5|max:255',
            'description' => 'required|min:20',
            'category' => 'required',
            'price' => 'required|numeric|min:1000',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            'status' => 'nullable|in:draft,published',
        ]);

        // ambil provider
        $provider = Provider::where('user_id', Auth::id())->first();

        // kalau provider tidak ditemukan
        if (!$provider) {
            return redirect('/become-provider')
                ->with('error', 'Lengkapi profil penyedia terlebih dahulu.');
        }

        // upload image
        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('services', 'public');
        }

        // status final
        $finalStatus = $request->status ?? 'draft';

        // simpan service
        Service::create([
            'provider_id' => $provider->id,
            'title' => $request->title,
            'slug' => Str::slug($request->title . '-' . uniqid()),
            'description' => $request->description,
            'category' => $request->category,
            'price' => $request->price,
            'image' => $imagePath,
            'status' => $finalStatus,
        ]);

        // redirect sukses
        return redirect()
            ->route('seller.dashboard')
            ->with(
                'success',
                $finalStatus === 'published'
                    ? 'Jasa berhasil dipublikasikan!'
                    : 'Jasa berhasil disimpan sebagai draft!'
            );
    }

    public function edit($id)
    {
        $service = Service::findOrFail($id);

        // security ownership
        if ($service->provider->user_id != Auth::id()) {
            abort(403);
        }

        return view('seller-pages.services.edit', compact('service'));
    }

    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);

        // ownership check
        if ($service->provider->user_id != Auth::id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|min:5|max:255',
            'description' => 'required|min:20',
            'category' => 'required',
            'price' => 'required|numeric|min:1000',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            'status' => 'nullable|in:draft,published',
        ]);

        // update image
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('services', 'public');

            // hapus image lama
            if ($service->image) {
                Storage::disk('public')->delete($service->image);
            }

            $service->image = $imagePath;
        }

        // update data
        $service->title = $request->title;
        $service->slug = Str::slug($request->title . '-' . uniqid());
        $service->description = $request->description;
        $service->category = $request->category;
        $service->price = $request->price;
        $service->status = $request->status ?? 'draft';

        $service->save();

        return redirect()
            ->route('seller.dashboard')
            ->with('success', 'Jasa berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);

        // security ownership check
        if ($service->provider->user_id != Auth::id()) {
            abort(403);
        }

        // delete image jika ada
        if ($service->image) {
            Storage::disk('public')->delete($service->image);
        }

        // delete service
        $service->delete();

        return redirect()
            ->route('seller.dashboard')
            ->with('success', 'Jasa berhasil dihapus!');
    }
}
