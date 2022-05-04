<?php 

interface EventListenerInterface
{
   public function attachEvent ($method);
   public function detouchEvent ($method);
}