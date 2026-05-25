<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Service;
use App\Models\SavedService;

class SavedServiceController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();

        $services = $user
            ->savedServices()
            ->with([
                'provider:id,user_id,name,slug,avatar',
            ])
            ->latest()
            ->paginate(12);

        return view(
            'pages.saved.index',
            compact('services')
        );
    }

    public function store(Service $service)
    {
        /** @var User $user */
        $user = Auth::user();

        $user->savedServices()
            ->syncWithoutDetaching([
                $service->id,
            ]);

        return back()->with(
            'success',
            'Jasa berhasil disimpan.'
        );
    }

    public function destroy(Service $service)
    {
        /** @var User $user */
        $user = Auth::user();

        $user->savedServices()
            ->detach($service->id);

        return back()->with(
            'success',
            'Jasa dihapus dari tersimpan.'
        );
    }
}
