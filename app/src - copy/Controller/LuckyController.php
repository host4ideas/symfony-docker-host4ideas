<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

// class LuckyController
class LuckyController extends AbstractController
{
    /**
     * @Route("/lucky/number")
     */
    public function number(): Response
    {
        $number = random_int(0, 100);

        // return new Response(
        //     '<html><body>Lucky number: '.$number.'</body></html>'
        // );

        // Return a variable so twig can use it
        return $this->render('lucky/number.html.twig', [
            'number' => $number,
        ]);
    }
}
