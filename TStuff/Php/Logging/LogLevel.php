<?php
namespace TStuff\Php\Logging  ; 

    abstract class LogLevel  {
        const Trace =   0b00000001;
        const Debug =   0b00000010;
        const Info =    0b00000100;
        const Warning = 0b00001000;
        const Error =   0b00010000;
        const Fatal =   0b00100000;
       
    }