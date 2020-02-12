<?php
namespace App\Controller;

use App\Entity\Alcool;
use App\Entity\Category;

use App\Entity\Cocktail;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AlcoolController extends Controller{

    /**
     * @Route("/category", name="category_list")
     */
    public function showCategories(){

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
     * @Route("/ingredient/{name}", name="cocktail_show_ingr")
     */
    public function showCocktailFromIngredient($name){
        $cocktail = $this->getDoctrine()->getRepository(Cocktail::class)->getCoktailFromIngredient($name);
        return $this->render('alcools/show.html.twig', array('cocktails' => $cocktail));
    }

    /**
     * @Route("/cocktail/{id}", name="cocktail_show")
     * returns All cocktail details from it's ID
     */
    public function showCoktailDetailsFromId($id){
        $cocktail = $this->getDoctrine()->getRepository(Cocktail::class)->getCoktailDetailsFromId($id);

        $cocktailDetails = $cocktail->drinks[0];
        $cocktailName = $cocktailDetails->{'strDrink'};
        $cocktailImg = $cocktailDetails->{'strDrinkThumb'};
        $cocktailInstructions = $cocktailDetails->{'strInstructions'};
        $cocktailGlass = $cocktailDetails->{'strGlass'};
        $cocktailIngredients = [];
        $cocktailMeasures = [];
        //A cocktail can have up to 15 ingredients
        for ($i = 1; $i <= 15; $i++) {
            array_push($cocktailIngredients, $cocktailDetails->{'strIngredient'.$i});
            array_push($cocktailMeasures, $cocktailDetails->{'strMeasure'.$i});
        }
        return $this->render('alcools/showCocktailDetails.html.twig', array('Name' => $cocktailName, 'Ingredients' => $cocktailIngredients, 'Measures' => $cocktailMeasures, 'Instructions' => $cocktailInstructions, 'Glass' => $cocktailGlass, 'imgDrink' => $cocktailImg));
    }


    /**
     * @Route("/alcool/{id}", name="alcool_show")
     */
    public function show($id){
        $alcools = $this->getDoctrine()->getRepository(Alcool::class)->find($id);

        return $this->render('alcools/show.html.twig', array('alcools' => $alcools));
    }

    /**
     * @Route("/ingredientsearch", name="searchCocktail")
     * @Method({"POST"})
     */
    public function searchIngredient(Request $request){
        $name = $request->request->get('_ingredient');
        $ingredient = $this->getDoctrine()->getRepository(Cocktail::class)->getCoktailDetailsFromName($name);
        $ingredientDetails = $ingredient->ingredients[0];
        if(empty($ingredientDetails)){
            $isIngredientNull = '';
            return $this->render('alcools/ingredient.html.twig', array('isIngredient' => $isIngredientNull));
        }else {
            $isIngredientNull = 'notnull';
            $ingredientID = $ingredientDetails->{'idIngredient'};
            $ingredientName = $ingredientDetails->{'strIngredient'};
            $ingredientDescription = $ingredientDetails->{'strDescription'};
            $ingredientType = $ingredientDetails->{'strType'};
            $ingredientAlcohol = $ingredientDetails->{'strAlcohol'};
            $ingredientABV = $ingredientDetails->{'strABV'};
            if($ingredientAlcohol){
                $ingredientAlcohol = 'Alcoholic';
            }else{
                $ingredientAlcohol = 'Non Alcoholic';
            }
            return $this->render('alcools/ingredient.html.twig', array('isIngredient' => $isIngredientNull, 'ID' => $ingredientID, 'Name' => $ingredientName, 'Description' => $ingredientDescription, 'Type' => $ingredientType, 'isAlcoholic' => $ingredientAlcohol, 'ABV' => $ingredientABV));
        }
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

    /**
     * @Route("/ingredients/")
     */
    public function getIngredients()
    {
        $ingredient = $this->getDoctrine()->getRepository(Cocktail::class)->getIngredients();
        $ingredients = [];


        for ($i = 0; $i <= sizeof($ingredient)-1; $i++) {
            $ingredientName = $ingredient[$i]->{'strIngredient1'};
            $ingredientDetails = $this->getDoctrine()->getRepository(Cocktail::class)->getIngredientIDfromName($ingredientName);
            $ingredientID = $ingredientDetails[0]->{'idIngredient'};
            var_dump($ingredientID);
            array_push($ingredients, $ingredientID);
        }
        return $this->render('ingredients/index.html.twig', array('ingredients' => $ingredients));
    }
}
