<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\testRepositoryInterface;


class test extends Controller
{
    public $testRepositoryInterface;

    public function __construct(testRepositoryInterface $testRepositoryInterface){
        $this->testRepositoryInterface = $testRepositoryInterface;
    }

    public function getAll(){
        return $this->testRepositoryInterface->getAll();
    }


    
}


