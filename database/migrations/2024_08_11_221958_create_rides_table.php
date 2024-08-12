    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration
    {
        /**
         * Run the migrations.
         */
        public function up(): void
        {
            Schema::create('rides', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->foreignId('driver_id')->nullable()->constrained('drivers', 'user_id')->onDelete('set null');
                $table->string('pickup_location');
                $table->string('dropoff_location');
                $table->decimal('pickup_lat')->nullable();
                $table->decimal('pickup_lng')->nullable();
                $table->decimal('dropoff_lat')->nullable();
                $table->decimal('dropoff_lng')->nullable();
                $table->string('note')->nullable();
                $table->integer('rating')->nullable();
                $table->string('comment')->nullable();
                $table->decimal('fare', 8, 2)->nullable();
                $table->enum('status', ['requested', 'in_progress', 'completed', 'canceled']);
                $table->timestamp('pickup_time')->nullable();
                $table->timestamp('dropoff_time')->nullable();
                $table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('rides');
        }
    };
