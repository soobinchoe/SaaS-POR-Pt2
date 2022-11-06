<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $seedGenre = [
            [ "name" => "Unknown", "description" => ""],
            [ "name" => "Fiction", "description" => ""],
            [ "name" => "Non-Fiction", "description" => ""],
            [ "name" => "Autobiography", "description" => ""],
            [ "name" => "Science Fiction", "description" => ""],
            [ "name" => "History", "description" => ""],
            [ "name" => "Technical", "description" => ""],
            [ "name" => "LGBTQI+", "description" => ""],
            [ "name" => "Classic", "description" => ""],
            [ "name" => "Science", "description" => ""],
            [ "name" => "Novel", "description" => ""],
            [ "name" => "Philosophy", "description" => ""],
        ];

        foreach ($seedGenre as $seedG) {
            Genre::create($seedG);
        }
    }
}
