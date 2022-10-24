<?php

namespace Database\Seeders;

use App\Models\Publisher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PublisherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $seedPublishers = [
            [ "name" => "Houghton Mifflin Harcourt Publishing Company", "city" => "Boston", "country_code" => "USA",],
            [ "name" => "Ars Libri Ltd.", "city" => "Boston", "country_code" => "USA",],
            [ "name" => "DOM Publishers", "city" => "Berlin", "country_code" => "DEU",],
            [ "name" => "Reprodukt", "city" => "Berlin", "country_code" => "DEU",],
            [ "name" => "Reise Know-How Verlag Tondok", "city" => "Munich", "country_code" => "DEU",],
            [ "name" => "Audible GmbH", "city" => "Munich", "country_code" => "DEU",],
            [ "name" => "Claudio Medien GmbH", "city" => "Munich", "country_code" => "DEU",],
            [ "name" => "Norma Editorial S A", "city" => "Barcelona", "country_code" => "ESP",],
            [ "name" => "Ediciones Salamandra", "city" => "Barcelona", "country_code" => "ESP",],
            [ "name" => "Montena Random House Mondadori", "city" => "Barcelona", "country_code" => "ESP",],
            [ "name" => "Welsh Books Council", "city" => "Aberystwyth", "country_code" => "GBR",],
            [ "name" => "Brandbooks", "city" => "Aylesbury", "country_code" => "GBR",],
            [ "name" => "Maximilian Thomas Publishing", "city" => "Aylesbury", "country_code" => "GBR",],
            [ "name" => "McGraw-Hill Education", "city" => "Maidenhead", "country_code" => "GBR",],
            [ "name" => "Open University Press", "city" => "Maidenhead", "country_code" => "GBR",],
            [ "name" => "Wisdom Tree", "city" => "Reading", "country_code" => "GBR",],
            [ "name" => "Garnet Education", "city" => "Reading", "country_code" => "GBR",],
            [ "name" => "Garnet Publishing Ltd.", "city" => "Reading", "country_code" => "GBR",],
            [ "name" => "Manchester University Press", "city" => "Manchester", "country_code" => "GBR",],
            [ "name" => "i2i Publishing", "city" => "Manchester", "country_code" => "GBR",],
            [ "name" => "Crécy Publishing", "city" => "Manchester", "country_code" => "GBR",],
            [ "name" => "International Journal of Management, Economics and Social Sciences (IJMESS)", "city" => "Houston", "country_code" => "USA",],
            [ "name" => "Third Coast Publishers LLP", "city" => "Houston", "country_code" => "USA",],
            [ "name" => "Chronicle Books", "city" => "San Francisco", "country_code" => "USA",],
            [ "name" => "Berrett Koehler Publishers, Inc.", "city" => "San Francisco", "country_code" => "USA",],
            [ "name" => "Plus One Press", "city" => "San Francisco", "country_code" => "USA",],
            [ "name" => "ZB Printing", "city" => "San Francisco", "country_code" => "USA",],
            [ "name" => "eBooks West", "city" => "Perth", "country_code" => "AUS",],
            [ "name" => "Chargan My Book Publisher", "city" => "Perth", "country_code" => "AUS",],
            [ "name" => "Magabala Books", "city" => "Broome", "country_code" => "AUS",],
            [ "name" => "Ethicool Books", "city" => "Hobart", "country_code" => "AUS",],
            [ "name" => "Boolarong Press", "city" => "Salisbury", "country_code" => "AUS",],
            [ "name" => "Big Sky Publishing", "city" => "Newport", "country_code" => "AUS",],
            [ "name" => "Cool Well Press, Inc.", "city" => "Newport", "country_code" => "USA",],
            [ "name" => "Sea of Stories Inc.", "city" => "Bordeaux", "country_code" => "FRA",],
            [ "name" => "La Compagnie Créative", "city" => "Bordeaux", "country_code" => "FRA",],
        ];

        foreach ($seedPublishers as $seedPublisher) {
            Publisher::create($seedPublisher);
        }
    }
}
