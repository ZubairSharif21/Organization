<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('business_name')->nullable();
            $table->enum('business_type', ['sole proprietorship', 'partnership', 'LLC', 'cooperative', 'nonprofit organization', 'franchise', 'joint venture', 'corporation', 'limited partnership'])->nullable();
            // $table->enum('time_zone', ['Asia/Kabul','Europe/London','America/New_York','Europe/Tirane','Africa/Algiers','Asia/Karachi','Europe/Andorra'])->nullable();
            $table->date('time_zone')->nullable();
            // $table->enum('facial_year', ['january_december', 'february_january', 'april_march', 'july_june','august_september','october_november'])->nullable();
            $table->string('facial_year')->nullable();
            $table->string('start_date')->default(now());
            // $table->enum('currency', ['USD', 'EUR', 'JPY', 'GBP', 'CHF', 'CAD', 'AUD', 'CNY', 'HKD', 'NZD', 'SEK', 'KRW', 'SGD', 'NOK', 'MXN', 'INR', 'RUB', 'ZAR', 'TRY', 'BRL', 'TWD', 'DKK', 'PLN', 'THB', 'IDR', 'MYR', 'HUF', 'CZK', 'ILS', 'CLP'])->nullable();
            $table->string('currency')->nullable();
            $table->integer('license_num')->nullable();
            $table->string('contact_name')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('street_address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();

            $table->integer('zip_code')->nullable();
            // $table->enum('country',['Afghanistan', 'Albania', 'Algeria', 'Argentina', 'Australia', 'Austria', 'Bangladesh', 'Belarus', 'Belgium', 'Brazil', 'Canada', 'Chile', 'China', 'Colombia', 'Croatia', 'Czech Republic', 'Denmark', 'Egypt', 'Finland', 'France', 'Germany', 'Greece', 'Hungary', 'India', 'Indonesia', 'Iran', 'Iraq', 'Ireland', 'Israel', 'Italy', 'Japan', 'Mexico', 'Netherlands', 'New Zealand', 'Nigeria', 'Norway', 'Pakistan', 'Peru', 'Philippines', 'Poland', 'Portugal', 'Romania', 'Russia', 'Saudi Arabia', 'Serbia', 'Singapore', 'South Africa', 'South Korea', 'Spain', 'Sweden', 'Switzerland', 'Taiwan', 'Thailand', 'Turkey', 'Ukraine', 'United Arab Emirates', 'United Kingdom', 'United States', 'Vietnam'])->nullable();
            $table->string('country')->nullable();

            $table->string('phone')->nullable();
            $table->string('website')->nullable();
            $table->integer('user_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organizations');
    }
}
