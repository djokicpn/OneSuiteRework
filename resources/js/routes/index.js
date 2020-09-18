import QaPortal from "../views/QaPortal.vue";
import QaGeneral from "../components/QaGeneral.vue";
import RecipeRaw from "../components/QaRecipeRaw.vue";
import IngredientDeclaration from "../components/QaIngredientDeclaration.vue";
import Home from "../views/Home.vue";


export default {
    mode: "history",
    routes: [
        {
            path: "/qa",
            name: "Qa",
            component: QaPortal,
            children: [
                {
                    path: "qa-general",
                    name: "qa-general",
                    component: QaGeneral
                },
                {
                    path: "qa-ingredient-dec",
                    name: "qa-ingredient-dec",
                    component: IngredientDeclaration
                },
                {
                    path: "qa-recipe-raw",
                    name: "qa-recipe-raw",
                    component: RecipeRaw
                }
            ]
        },
        {
            path: "/about",
            name: "About",
            component: () =>
                import(/* webpackChunkName: "about" */ "../views/About.vue")
        },
        {
            path: "/home",
            name: "Home",
            component: Home
        }
    ]
};
