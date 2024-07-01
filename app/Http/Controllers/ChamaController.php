<!-- 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chama;
use App\Models\Member;
use App\Models\User;
use Illuminate\Support\Str;

class ChamaController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:chamas,email',
            'max_members' => 'required|integer|min:1',
            'members' => 'required|array|min:1',
            'members.*.name' => 'required|string|max:255',
            'members.*.email' => 'required|email',
            'members.*.role' => 'required|string|in:member,treasurer,super_admin',
        ]);

        $chama = Chama::create([
            'name' => $request->name,
            'email' => $request->email,
            'max_members' => $request->max_members,
            'special_code' => Str::random(10),
        ]);

        foreach ($request->members as $memberData) {
            $user = User::create([
                'name' => $memberData['name'],
                'email' => $memberData['email'],
                'password' => bcrypt('password'), // default password, should be changed
            ]);

            $user->assignRole($memberData['role']);

            $chama->members()->create([
                'user_id' => $user->id,
                'name' => $memberData['name'],
                'email' => $memberData['email'],
                'role' => $memberData['role'],
            ]);
        }

        return response()->json($chama);
    }

    public function join(Request $request)
    {
        $request->validate([
            'special_code' => 'required|string|exists:chamas,special_code',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:members,email',
        ]);

        $chama = Chama::where('special_code', $request->special_code)->first();

        if ($chama->members->count() < $chama->max_members) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt('password'), // default password, should be changed
            ]);

            $user->assignRole('member');

            $chama->members()->create([
                'user_id' => $user->id,
                'name' => $request->name,
                'email' => $request->email,
                'role' => 'member',
            ]);

            return response()->json(['message' => 'Joined successfully']);
        } else {
            return response()->json(['message' => 'Chama is full'], 403);
        }
    }
} -->
