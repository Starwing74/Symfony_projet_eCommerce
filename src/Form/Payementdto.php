<?php

namespace App\Form;
use Symfony\Component\Validator\Constraints as Assert;

class Payementdto
{

    #[Assert\Length(max: 16)]
    #[Assert\CardScheme(
        schemes: [Assert\CardScheme::VISA],
        message: 'Your credit card number is invalid.',
    )]
    public string $Nbcarte;

    #[Assert\Length(exactly: 3)]
    public string  $CVC;

    #[Assert\Length(exactly: 4)]
    public int $Date_year;

    #[Assert\Length(min: 1, max: 2)]
    public int $Date_month;

}