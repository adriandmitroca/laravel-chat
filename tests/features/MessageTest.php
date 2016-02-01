<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MessageTest extends TestCase
{

    use DatabaseMigrations, DatabaseTransactions;


    public function test_message_can_be_added_properly()
    {
        $example = [ 'author' => 'John Doe', 'content' => 'I\'m just testing' ];

        $this->visit('/')->submitForm('Send', $example)->seeInDatabase('messages', $example);
    }


    public function test_message_cant_be_added_without_author()
    {
        $example = [ 'content' => 'I\'m just testing' ];

        $this->visit('/')->submitForm('Send', $example)->notSeeInDatabase('messages', $example);
    }


    public function test_message_cant_be_added_without_content()
    {
        $example = [ 'author' => 'John Doe' ];

        $this->visit('/')->submitForm('Send', $example)->notSeeInDatabase('messages', $example);
    }


    public function test_message_author_cant_be_longer_than_20()
    {
        $example = [ 'author' => 'Taumatawhakatangihangakoauauotamateapokaiwhenuakitanatahu' ];

        $this->visit('/')->submitForm('Send', $example)->notSeeInDatabase('messages', $example);
    }
}
