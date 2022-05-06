<?php 

interface LoggerInterface 
{
    public function logMessage($stringError);
    public function lastMessages($num);
}