<?php

namespace App\DataFixtures;

use App\Entity\Vehicle;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class VehicleFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $vehicles = [
            ['Audi RS7', 95000, 15000, 2022, 'Essence', 'images/vehicles/ford_mustang.jpg'],
            ['Audi R8', 130000, 12000, 2021, 'Essence', 'images/vehicles/ford_mustang.jpg'],
            ['BMW Q4 M4 Cabriolet', 110000, 8000, 2023, 'Essence', 'images/vehicles/Q4_M4Cabriolet.png'],
            ['Mercedes SLK', 65000, 20000, 2019, 'Essence', 'images/vehicles/merco_SLK.png'],
            ['Opel Corsa', 4790, 177220, 2008, 'Diesel', 'images/vehicles/opel_corsa.jpg'],
            ['Volkswagen Polo', 7290, 177261, 2010, 'Diesel', 'images/vehicles/volkswagen_polo.jpg'],
            ['Tesla Model S', 85000, 5000, 2021, 'Électrique', 'images/vehicles/tesla_model_s.jpg'],
            ['Ford Mustang', 55000, 35000, 2017, 'Essence', 'images/vehicles/ford_mustang.jpg'],
            ['Chevrolet Camaro', 60000, 25000, 2018, 'Essence', 'images/vehicles/chevroletcamaro.png']
        ];

        foreach ($vehicles as [$name, $price, $mileage, $year, $fuelType, $image]) {
            $vehicle = new Vehicle();
            $vehicle->setName($name);
            $vehicle->setPrice($price);
            $vehicle->setMileage($mileage);
            $vehicle->setYear($year);
            $vehicle->setFuelType($fuelType);
            $vehicle->setImage($image);
            $manager->persist($vehicle);
        }

        $manager->flush();
    }
}
