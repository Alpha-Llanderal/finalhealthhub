namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }
}

// Fetch all appointments for a specific user
App\Models\Appointment::where('user_id', 1)->get();

// Fetch a user's medical records
App\Models\User::find(1)->medicalRecords;

// Fetch all laboratory tests
App\Models\LaboratoryTest::all();
