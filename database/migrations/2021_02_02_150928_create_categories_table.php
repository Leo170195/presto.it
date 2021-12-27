<?php

use App\Models\Ad;
use App\Models\Category;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('icon');
            $table->timestamps();
        });

        $categories = [
            'Auto'=>'fas fa-car',
            'Moto'=>'fas fa-biking',
            'Elettronica'=>'fas fa-blender-phone',
            'Immobili'=>'fas fa-home',
            'Informatica'=>'fas fa-laptop',
            'Tempo libero'=>'fas fa-golf-ball',
            'Libri'=>'fas fa-book',
            'Videogame'=>'fas fa-gamepad',
            'Abbigliamento'=>'fas fa-tshirt',
            'Gioielli'=>'fas fa-gem',
        ];

        foreach ($categories as $name => $icon) {
            $c = new Category();
            $c->name = $name;
            $c->icon = $icon;
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
        Schema::dropIfExists('categories');
    }
}
