<?php
namespace App\Repository;


interface CategoryRepositoryInterface
{
   public function createCategory($data);
   public function updateCategory($id , $data);
   public function tree($id = null);
}