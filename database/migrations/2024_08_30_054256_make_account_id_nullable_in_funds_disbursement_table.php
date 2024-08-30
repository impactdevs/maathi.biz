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
        Schema::table('funds_disbursement', function (Blueprint $table) {
            // Drop the foreign key constraint if it exists
            $table->dropForeign(['account_id']);

            // Make the column nullable
            $table->unsignedBigInteger('account_id')->nullable()->change();

            // Re-add the foreign key constraint
            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('funds_disbursement', function (Blueprint $table) {
            // Drop the foreign key constraint
            $table->dropForeign(['account_id']);

            // Revert the column to be non-nullable
            $table->unsignedBigInteger('account_id')->nullable(false)->change();

            // Re-add the foreign key constraint
            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade');
        });
    }
};
