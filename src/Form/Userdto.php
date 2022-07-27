<?php

namespace App\Form;
use Symfony\Component\Validator\Constraints as Assert;

class Userdto
{
    #[Assert\Length(min: 2)]
    public string $Name;

    #[Assert\Email]
    public ?string $Mail = null;

    #[Assert\Password]
    public ?string $Password = null;

}