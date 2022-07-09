<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class viewmovie extends TestCase
{
 public function the_main_page()
 {
    $response = $this->get(route('index'));

    $response->assertSuccessfull();
 }    
}
