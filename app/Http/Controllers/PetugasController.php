namespace App\Http\Controllers;
use App\Models\Petugas;
use Illuminate\Http\Request;

class PetugasController extends Controller {
    public function index() {
        $data_petugas = Petugas::all();
        return view('petugas.index', compact('data_petugas'));
    }
}