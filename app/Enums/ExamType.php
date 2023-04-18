<?php

namespace App\Enums;

enum ExamType : int
{
    case Quiz = 1;
    case MidTerm = 2;
    case Final = 3;
}
