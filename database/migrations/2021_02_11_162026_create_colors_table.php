<?php

use App\Models\Color;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colors', function (Blueprint $table) {
            $table->id();
            $table->string('color');
            $table->timestamps();
        });
        $colors = [
            'red', 'blue', 'yellow', 'green', 'brown', 'black', 'orange', 'purple', 'gray', 'violet'
        ];

        foreach ($colors as $color) {
            $c = new Color();
            $c->color = $color;
            $c->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('colors');
    }
}
