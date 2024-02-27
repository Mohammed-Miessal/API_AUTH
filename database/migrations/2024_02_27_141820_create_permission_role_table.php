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
        // Schema::create('permission_role', function (Blueprint $table) {
        //     $table->id();
        //     $table->unsignedBigInteger('permission_id');
        //     $table->unsignedBigInteger('role_id');

        //     $table->foreignId('permission_id')->references('id')->on('permissions')->onDelete('cascade')->onUpdate('cascade');
        //     $table->foreignId('role_id')->references('id')->on('roles')->onDelete('cascade')->onUpdate('cascade');

        //     $table->timestamps();
        // });
        Schema::create('permission_role', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('permission_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('role_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            
            $table->timestamps();
            
            $table->unique(['permission_id', 'role_id']); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permission_role');
    }
};
