<?php

namespace App\Controller;

use App\Repository\VehicleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Vehicle;

class VehicleController extends AbstractController
{
    #[Route('/vehicles', name: 'vehicle_list')]
    public function index(VehicleRepository $vehicleRepository, Request $request)
    {
        // Récupérer les filtres depuis la requête GET
        $minMileage = $request->query->get('min_mileage', 0);
        $maxMileage = $request->query->get('max_mileage', 300000);
        $minPrice = $request->query->get('min_price', 0);
        $maxPrice = $request->query->get('max_price', 100000);
        $minYear = $request->query->get('min_year', 2000);
        $maxYear = $request->query->get('max_year', 2024);

        // Obtenir les véhicules filtrés
        $vehicles = $vehicleRepository->findByFilters($minMileage, $maxMileage, $minPrice, $maxPrice, $minYear, $maxYear);

        return $this->render('vehicle/index.html.twig', [
            'vehicles' => $vehicles,
        ]);
    }

    #[Route('/vehicle/{id}', name: 'vehicle_details')]
    public function show(Vehicle $vehicle)
    {
        return $this->render('vehicle/show.html.twig', [
            'vehicle' => $vehicle,
        ]);
    }
}
