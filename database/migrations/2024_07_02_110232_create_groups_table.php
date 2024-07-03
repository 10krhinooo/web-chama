<!--  

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['investment', 'savings', 'loan']);
            $table->integer('max_members');
            $table->string('country');
            $table->string('currency');
            $table->boolean('is_registered');
            $table->timestamps();
        });
    }
    

   
    public function down(): void
    {
        Schema::dropIfExists('groups');
    }
};  -->
