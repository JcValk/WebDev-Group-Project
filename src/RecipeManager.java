import java.util.ArrayList;
import java.util.List;

public class RecipeManager {
    private final List<Recipe> recipes = new ArrayList<>();

    public void addRecipe(Recipe recipe) {
        recipes.add(recipe);
    }

    public Recipe findRecipeByName(String name) {
        for (Recipe recipe : recipes) {
            if (recipe.getName().equalsIgnoreCase(name)) {
                return recipe;
            }
        }
        return null;
    }

    // Prints a single recipe by name
    public void printRecipe(String name) {
        Recipe recipe = findRecipeByName(name);
        if (recipe != null) {
            System.out.println(recipe);
            return;
        }
        System.out.println("Recipe not found");
    }

    // Prints all recipes with their details
    public void printRecipes() {
        for (Recipe recipe : recipes) {
            System.out.println(recipe);
        }
    }

    // Prints all recipe names with their index
    public void printAllRecipeNames() {
        int counter = 0;
        for (Recipe recipe : recipes) {
            System.out.println(counter + ". Recipe: " + recipe.getName());
            counter++;
        }
    }

    // Demo main
    public static void main(String[] args) {
        RecipeManager manager = new RecipeManager();

        Recipe pancakes = new Recipe("Pancakes");
        pancakes.addIngredient(new Ingredient("Flour", "2 cups"));
        pancakes.addIngredient(new Ingredient("Milk", "1.5 cups"));
        pancakes.addIngredient(new Ingredient("Eggs", "2"));
        pancakes.setInstructions("Mix ingredients and cook on griddle.");

        Recipe salad = new Recipe("Salad");
        salad.addIngredient(new Ingredient("Lettuce", "1 head"));
        salad.addIngredient(new Ingredient("Tomato", "2"));
        salad.setInstructions("Chop and toss with dressing.");

        manager.addRecipe(pancakes);
        manager.addRecipe(salad);

        System.out.println("-- All Recipes --");
        manager.printRecipes();

        System.out.println("-- Recipe Names --");
        manager.printAllRecipeNames();

        System.out.println("-- Search Pancakes --");
        manager.printRecipe("Pancakes");
    }
}
