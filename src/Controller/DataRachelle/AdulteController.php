<?php

namespace App\Controller\DataRachelle;

use App\Repository\DataAnalyseRepository;
use App\Service\Breadcrumb;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/parametre/adulte')]
class AdulteController extends AbstractController
{

    #[Route('/', name: 'app_point_adulte_index')]
    public function indexGenre(Request $request)
    {
        return $this->render('datarachelle/adulte/index.html.twig');
    }

    #[Route('/data/temps/plein/citoyen', name: 'app_rh_dashboard_temps_plein_partiel_adulte_data')]
    public function dataTypeContrat(Request $request, DataAnalyseRepository $employeRepository)
    {
        $all = $request->query->all();
        $filters = $all['filters'] ?? [];
        $dataAnnees = $employeRepository->getAnneeRangeContrat('Temps plein', 'Adulte', 'Citoyen canadien et Indien');
        $dataAnneesPartiel = $employeRepository->getAnneeRangeContrat('Temps partiel', 'Adulte', 'Citoyen canadien et Indien');
        $annees = range($dataAnnees['min_year'], $dataAnnees['max_year']);
        $data = $employeRepository->getData('Temps plein', 'Adulte', 'Citoyen canadien et Indien');
        $dataPartiel = $employeRepository->getData('Temps partiel', 'Adulte', 'Citoyen canadien et Indien');


        foreach ($data as $_row) {
            if ($_row['genre'] == 'F') {
                $seriesF[] = (int)$_row['_total'];
            } elseif ($_row['genre'] == 'M') {
                $seriesM[] = (int)$_row['_total'];
            } else {
                $seriesN[] = (int)$_row['_total'];
            }

            //  $series[0]['data'][] = $_row['_total'];
        }
        foreach ($dataPartiel as $_row) {
            if ($_row['genre'] == 'F') {
                $seriesPF[] = (int)$_row['_total'];
            } elseif ($_row['genre'] == 'M') {
                $seriesPM[] = (int)$_row['_total'];
            } else {
                $seriesPN[] = (int)$_row['_total'];
            }

            //  $series[0]['data'][] = $_row['_total'];
        }

        $series = [
            'plein' => [
                [
                    "name" => 'Masculin',
                    "data" => $seriesM,
                ],
                [
                    "name" => 'Féminin',
                    "data" => $seriesF
                ], [
                    "name" => 'NA',
                    "data" => $seriesN
                ]
            ],
            'partiel' => [
                [
                    "name" => 'Masculin',
                    "data" => $seriesPM,
                ],
                [
                    "name" => 'Féminin',
                    "data" => $seriesPF
                ], [
                    "name" => 'NA',
                    "data" => $seriesPN
                ]
            ]
        ];

        $dataDate = [
            'plein' => $dataAnnees,
            'partiel' => $dataAnneesPartiel

        ];
        //dd($this->json($series));
        //, 'range' => $dataAnnees['plein']['min_year'] . ' to ' . $dataAnnees['plein']['max_year'], 'rangePartiel' => $dataAnnees['partiel']['min_year'] . ' to ' . $dataAnnees['partiel']['max_year']
        return $this->json(['series' => $series, 'annees' => $dataDate, 'range' => 'Range :' . $dataDate['plein']['min_year'] . ' to ' . $dataDate['plein']['max_year'], 'rangePartiel' => 'Range :' . $dataDate['partiel']['min_year'] . ' to ' . $dataDate['partiel']['max_year']]);
    }

    #[Route('/data/temps/plein/international', name: 'app_rh_dashboard_temps_plein_partiel_adulte_International_data')]
    public function dataInternational(Request $request, DataAnalyseRepository $employeRepository)
    {
        $all = $request->query->all();
        $filters = $all['filters'] ?? [];
        $dataAnnees = $employeRepository->getAnneeRangeContrat('Temps plein', 'Adulte', 'International');
        $dataAnneesPartiel = $employeRepository->getAnneeRangeContrat('Temps partiel', 'Adulte', 'International');
        $annees = range($dataAnnees['min_year'], $dataAnnees['max_year']);
        $data = $employeRepository->getData('Temps plein', 'Adulte', 'International');
        $dataPartiel = $employeRepository->getData('Temps partiel', 'Adulte', 'International');


        foreach ($data as $_row) {
            if ($_row['genre'] == 'F') {
                $seriesF[] = (int)$_row['_total'];
            } elseif ($_row['genre'] == 'M') {
                $seriesM[] = (int)$_row['_total'];
            } else {
                $seriesN[] = (int)$_row['_total'];
            }

            //  $series[0]['data'][] = $_row['_total'];
        }
        foreach ($dataPartiel as $_row) {
            if ($_row['genre'] == 'F') {
                $seriesPF[] = (int)$_row['_total'];
            } elseif ($_row['genre'] == 'M') {
                $seriesPM[] = (int)$_row['_total'];
            } else {
                $seriesPN[] = (int)$_row['_total'];
            }

            //  $series[0]['data'][] = $_row['_total'];
        }

        $series = [
            'plein' => [
                [
                    "name" => 'Masculin',
                    "data" => $seriesM,
                ],
                [
                    "name" => 'Féminin',
                    "data" => $seriesF
                ], [
                    "name" => 'NA',
                    "data" => $seriesN
                ]
            ],
            'partiel' => [
                [
                    "name" => 'Masculin',
                    "data" => $seriesPM,
                ],
                [
                    "name" => 'Féminin',
                    "data" => $seriesPF
                ], [
                    "name" => 'NA',
                    "data" => $seriesPN
                ]
            ]
        ];

        $dataDate = [
            'plein' => $dataAnnees,
            'partiel' => $dataAnneesPartiel

        ];
        //dd($this->json($series));
        //, 'range' => $dataAnnees['plein']['min_year'] . ' to ' . $dataAnnees['plein']['max_year'], 'rangePartiel' => $dataAnnees['partiel']['min_year'] . ' to ' . $dataAnnees['partiel']['max_year']
        return $this->json(['series' => $series, 'annees' => $dataDate, 'range' => 'Range :' . $dataDate['plein']['min_year'] . ' to ' . $dataDate['plein']['max_year'], 'rangePartiel' => 'Range :' . $dataDate['partiel']['min_year'] . ' to ' . $dataDate['partiel']['max_year']]);
    }
    #[Route('/data/temps/plein/residence', name: 'app_rh_dashboard_temps_plein_partiel_adulte_residence_data')]
    public function dataResidence(Request $request, DataAnalyseRepository $employeRepository)
    {
        $all = $request->query->all();
        $filters = $all['filters'] ?? [];
        $dataAnnees = $employeRepository->getAnneeRangeContrat('Temps plein', 'Adulte', 'International');
        $dataAnneesPartiel = $employeRepository->getAnneeRangeContrat('Temps partiel', 'Adulte', 'International');
        $annees = range($dataAnnees['min_year'], $dataAnnees['max_year']);
        $data = $employeRepository->getData('Temps plein', 'Adulte', 'International');
        $dataPartiel = $employeRepository->getData('Temps partiel', 'Adulte', 'International');


        foreach ($data as $_row) {
            if ($_row['genre'] == 'F') {
                $seriesF[] = (int)$_row['_total'];
            } elseif ($_row['genre'] == 'M') {
                $seriesM[] = (int)$_row['_total'];
            } else {
                $seriesN[] = (int)$_row['_total'];
            }

            //  $series[0]['data'][] = $_row['_total'];
        }
        foreach ($dataPartiel as $_row) {
            if ($_row['genre'] == 'F') {
                $seriesPF[] = (int)$_row['_total'];
            } elseif ($_row['genre'] == 'M') {
                $seriesPM[] = (int)$_row['_total'];
            } else {
                $seriesPN[] = (int)$_row['_total'];
            }

            //  $series[0]['data'][] = $_row['_total'];
        }

        $series = [
            'plein' => [
                [
                    "name" => 'Masculin',
                    "data" => $seriesM,
                ],
                [
                    "name" => 'Féminin',
                    "data" => $seriesF
                ], [
                    "name" => 'NA',
                    "data" => $seriesN
                ]
            ],
            'partiel' => [
                [
                    "name" => 'Masculin',
                    "data" => $seriesPM,
                ],
                [
                    "name" => 'Féminin',
                    "data" => $seriesPF
                ], [
                    "name" => 'NA',
                    "data" => $seriesPN
                ]
            ]
        ];

        $dataDate = [
            'plein' => $dataAnnees,
            'partiel' => $dataAnneesPartiel

        ];
        //dd($this->json($series));
        //, 'range' => $dataAnnees['plein']['min_year'] . ' to ' . $dataAnnees['plein']['max_year'], 'rangePartiel' => $dataAnnees['partiel']['min_year'] . ' to ' . $dataAnnees['partiel']['max_year']
        return $this->json(['series' => $series, 'annees' => $dataDate, 'range' => 'Range :' . $dataDate['plein']['min_year'] . ' to ' . $dataDate['plein']['max_year'], 'rangePartiel' => 'Range :' . $dataDate['partiel']['min_year'] . ' to ' . $dataDate['partiel']['max_year']]);
    }
    #[Route('/data/temps/plein/legal', name: 'app_rh_dashboard_temps_plein_partiel_adulte_legal_data')]
    public function dataLegal(Request $request, DataAnalyseRepository $employeRepository)
    {
        $all = $request->query->all();
        $filters = $all['filters'] ?? [];
        $dataAnnees = $employeRepository->getAnneeRangeContrat('Temps plein', 'Adulte', 'International');
        $dataAnneesPartiel = $employeRepository->getAnneeRangeContrat('Temps partiel', 'Adulte', 'International');
        $annees = range($dataAnnees['min_year'], $dataAnnees['max_year']);
        $data = $employeRepository->getData('Temps plein', 'Adulte', 'International');
        $dataPartiel = $employeRepository->getData('Temps partiel', 'Adulte', 'International');


        foreach ($data as $_row) {
            if ($_row['genre'] == 'F') {
                $seriesF[] = (int)$_row['_total'];
            } elseif ($_row['genre'] == 'M') {
                $seriesM[] = (int)$_row['_total'];
            } else {
                $seriesN[] = (int)$_row['_total'];
            }

            //  $series[0]['data'][] = $_row['_total'];
        }
        foreach ($dataPartiel as $_row) {
            if ($_row['genre'] == 'F') {
                $seriesPF[] = (int)$_row['_total'];
            } elseif ($_row['genre'] == 'M') {
                $seriesPM[] = (int)$_row['_total'];
            } else {
                $seriesPN[] = (int)$_row['_total'];
            }

            //  $series[0]['data'][] = $_row['_total'];
        }

        $series = [
            'plein' => [
                [
                    "name" => 'Masculin',
                    "data" => $seriesM,
                ],
                [
                    "name" => 'Féminin',
                    "data" => $seriesF
                ], [
                    "name" => 'NA',
                    "data" => $seriesN
                ]
            ],
            'partiel' => [
                [
                    "name" => 'Masculin',
                    "data" => $seriesPM,
                ],
                [
                    "name" => 'Féminin',
                    "data" => $seriesPF
                ], [
                    "name" => 'NA',
                    "data" => $seriesPN
                ]
            ]
        ];

        $dataDate = [
            'plein' => $dataAnnees,
            'partiel' => $dataAnneesPartiel

        ];
        //dd($this->json($series));
        //, 'range' => $dataAnnees['plein']['min_year'] . ' to ' . $dataAnnees['plein']['max_year'], 'rangePartiel' => $dataAnnees['partiel']['min_year'] . ' to ' . $dataAnnees['partiel']['max_year']
        return $this->json(['series' => $series, 'annees' => $dataDate, 'range' => 'Range :' . $dataDate['plein']['min_year'] . ' to ' . $dataDate['plein']['max_year'], 'rangePartiel' => 'Range :' . $dataDate['partiel']['min_year'] . ' to ' . $dataDate['partiel']['max_year']]);
    }
}
