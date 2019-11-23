<?php
namespace App\Controller;

use App\Entity\Alcool;
use App\Entity\Category;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AlcoolController extends Controller{
    /**
     * @Route("/", name="category_list")
     * @Method({"GET"})
     */
    public function index(){

        $categories = $this->getDoctrine()->getRepository(Category::class)->findAll();
        return $this->render('categories/index.html.twig', array('categories' => $categories));
    }

    /**
     * @Route("/category/{id}", name="category_show")
     */
    public function showCocktailFromCategory($id){
        $cocktail = $this->getDoctrine()->getRepository(Category::class)->getCoktailFromCategory($id);
        return $this->render('alcools/show.html.twig', array('cocktails' => $cocktail));
    }

    /**
     * @Route("/cocktail/{id}", name="cocktail_show")
     */
    public function showCoktailDetailsFromId($id){
        $cocktail = $this->getDoctrine()->getRepository(Category::class)->getCoktailDetailsFromId($id);
        $cocktailDetails = $cocktail->drinks[0];
        $cocktailName = $cocktailDetails->{'strDrink'};
        $cocktailImg = $cocktailDetails->{'strDrinkThumb'};
        $cocktailInstructions = $cocktailDetails->{'strInstructions'};
        $cocktailGlass = $cocktailDetails->{'strGlass'};
        $cocktailIngredients = [];
        for ($i = 1; $i <= 15; $i++) {
            array_push($cocktailIngredients, $cocktailDetails->{'strIngredient'.$i});
        }
        return $this->render('alcools/showCocktailDetails.html.twig', array('Name' => $cocktailName, 'Ingredients' => $cocktailIngredients, 'Instructions' => $cocktailInstructions, 'Glass' => $cocktailGlass, 'imgDrink' => $cocktailImg));
    }


    /**
     * @Route("/alcool/{id}", name="alcool_show")
     */
    public function show($id){
        $alcools = $this->getDoctrine()->getRepository(Alcool::class)->find($id);

        return $this->render('alcools/show.html.twig', array('alcools' => $alcools));
    }

    /**
     * @Route("/save")
     * @Method({"POST"})
     */
    public function save(){
        $entityManager = $this->getDoctrine()->getManager();
        $alcool = new Alcool;

        $alcool->setTitle('azertyu');
        $alcool->setABV(7.00);
        $entityManager->persist($alcool);
        $entityManager->flush();

        return $this->redirectToRoute('alcool_show', [
            'id' => $alcool->getId()
        ]);
    }

    /**
     * @Route("/alcool/edit/{id}")
     */
    public function update($id)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $alcool = $entityManager->getRepository(Alcool::class)->find($id);

        if (!$alcool) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $alcool->setTitle('Vodka');
        $alcool->setABV(37.50);
        $entityManager->flush();

        return $this->redirectToRoute('alcool_show', [
            'id' => $alcool->getId()
        ]);
    }
}
