import java.util.ArrayList;
import java.util.List;

public class Recipe {
    private final String name;
    private final List<Ingredient> ingredients = new ArrayList<>();
    private String instructions = "";

    public Recipe(String name) {
        this.name = name;
    }

    public String getName() {
        return name;
    }

    public List<Ingredient> getIngredients() {
        return ingredients;
    }

    public String getInstructions() {
        return instructions;
    }

    public void setInstructions(String instructions) {
        this.instructions = instructions;
    }

    public void addIngredient(Ingredient ingredient) {
        ingredients.add(ingredient);
    }

    @Override
    public String toString() {
        StringBuilder sb = new StringBuilder();
        sb.append("Recipe: ").append(name).append("\n");
        sb.append("Ingredients:\n");
        for (Ingredient ing : ingredients) {
            sb.append("- ").append(ing).append("\n");
        }
        sb.append("Instructions: ").append(instructions).append("\n");
        return sb.toString();
    }
}
