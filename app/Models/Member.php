<!-- 
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = ['chama_id', 'user_id', 'name', 'email', 'role'];

    public function chama()
    {
        return $this->belongsTo(Chama::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
} -->
