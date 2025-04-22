<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserActivity;
use App\Traits\LogsUserActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{
    use LogsUserActivity;

    /**
     * Display the user's profile form.
     */
    public function index()
    {
        $user = Auth::user();
        $activities = UserActivity::getUserActivities($user->id, 10);

        return view('admin.profile', [
            'user' => $user,
            'activities' => $activities
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        try {
            $validated = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
                'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
                'phone' => ['nullable', 'string', 'max:20'],
                'bio' => ['nullable', 'string', 'max:1000'],
            ]);

            $user->update($validated);

            // Log aktivitas
            $this->logUserActivity('Informasi Profil Diubah', [
                'changes' => array_diff_assoc($validated, $user->getOriginal())
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Profil berhasil diperbarui'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui profil: ' . $e->getMessage()
            ], 422);
        }
    }

    /**
     * Update the user's password.
     */
    public function updatePassword(Request $request)
    {
        try {
            $user = Auth::user();
            
            $request->validate([
                'current_password' => ['required'],
                'new_password' => ['required', Password::defaults()],
                'confirm_password' => ['required', 'same:new_password'],
            ]);

            // Verifikasi password saat ini
            if (!Hash::check($request->current_password, $user->password)) {
                throw ValidationException::withMessages([
                    'current_password' => ['Password saat ini salah.'],
                ]);
            }

            $user->update([
                'password' => Hash::make($request->new_password),
            ]);

            // Log aktivitas
            $this->logUserActivity('Password Diubah');

            return response()->json([
                'success' => true,
                'message' => 'Password berhasil diperbarui'
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui password: ' . $e->getMessage()
            ], 422);
        }
    }

    /**
     * Upload profile photo.
     */
    public function uploadPhoto(Request $request)
    {
        try {
            $request->validate([
                'photo' => ['required', 'image', 'max:2048'],
            ]);

            $user = Auth::user();
            
            if ($user->photo) {
                // Hapus foto lama jika ada
                if (file_exists(public_path('storage/profiles/' . $user->photo))) {
                    unlink(public_path('storage/profiles/' . $user->photo));
                }
            }

            $fileName = time() . '.' . $request->photo->extension();
            $request->photo->storeAs('public/profiles', $fileName);

            $user->update([
                'photo' => $fileName,
            ]);

            // Log aktivitas
            $this->logUserActivity('Foto Profil Diubah');

            return response()->json([
                'success' => true,
                'message' => 'Foto profil berhasil diperbarui',
                'photo' => asset('storage/profiles/' . $fileName)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengunggah foto: ' . $e->getMessage()
            ], 422);
        }
    }

    /**
     * Get user activities.
     */
    public function getActivities(Request $request)
    {
        $user = Auth::user();
        $type = $request->type ?? 'all';
        $limit = $request->input('limit', 10);
        $page = $request->input('page', 1);
        $offset = ($page - 1) * $limit;

        $query = UserActivity::where('user_id', $user->id)->latest();

        // Filter berdasarkan tipe aktivitas
        if ($type !== 'all') {
            $query->where('activity', 'like', "%$type%");
        }

        $activities = $query->skip($offset)->take($limit)->get()->map(function($activity) {
            $activity->browser_info = UserActivity::getBrowserInfo($activity->user_agent);
            return $activity;
        });

        return response()->json([
            'success' => true,
            'activities' => $activities,
            'has_more' => $activities->count() == $limit
        ]);
    }
} 