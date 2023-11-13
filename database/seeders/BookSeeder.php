<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;

use Faker\Factory as Faker;

class BookSeeder extends Seeder
{
    public function run()
    {
        $json = file_get_contents('https://fakerapi.it/api/v1/books?_quantity=100000 ');
        $data = json_decode($json, true)['data'];

        foreach ($data as $item) {
            Book::create([
                'title' => $item['title'],
                'author' => $item['author'],
                'genre' => $item['genre'],
                'description' => $item['description'],
                'isbn' => $item['isbn'],
                'image' => $item['image'],
                'publication_date' => $item['published'],
                'publisher' => $item['publisher']
            ]);
        }
    }
}
