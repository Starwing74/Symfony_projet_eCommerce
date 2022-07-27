<?php

namespace App\Form;
use Symfony\Component\Validator\Constraints as Assert;

class Reviewdto
{
    #[Assert\Length(min: 1, max: 5)]
    public int $Note;
}