<?php

namespace App;

enum FormResponseStatus: int
{
    case Pending = 0;
    case Approved = 1;
    case Rejected = 2;


}
