<!-- 

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('loans', function (Blueprint $table) {
        $table->id();
        $table->foreignId('group_id')->constrained()->onDelete('cascade');
        $table->foreignId('member_id')->constrained()->onDelete('cascade');
        $table->decimal('amount', 10, 2);
        $table->enum('status', ['pending', 'approved', 'repaid']);
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
}; -->