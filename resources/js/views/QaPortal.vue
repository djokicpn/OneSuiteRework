<template>
  <div class="container-fluid">
    <div class="home">
      <div class="row">
        <div class="col-lg-3 col-md-4 col-xs-5 text-left">
          <div class="box box-nav-left">
            <div class="text-center">
              <h5>Progress</h5>
            </div>
            <ul class="qa-left-nav">
              <li-link :name="'qa-general'"> 1. General </li-link>
              <li-link :name="'qa-recipe-raw'">
                2. Recipe & Raw Materials
              </li-link>
              <li-link :name="'qa-ingredient-dec'">
                3. Ingredient Declaration</li-link
              >
              <!-- <li-link :name="'qa-allergens-sens'"> 4. Allergens & Sensitivies</li-link>
              <li-link :name="'qa-nutrition'"> 5. Nutrition</li-link>
              <li-link :name="'qa-finished-prod'"> 6. Finished Product Standards</li-link>
              <li-link :name="'qa-additinal-prod-info'"> 7. Additional Product Info</li-link>
              <li-link :name="'qa-storage'"> 8. Storage</li-link>
              <li-link :name="'qa-process-ctrl'"> 9. Process & Control Points</li-link>
              <li-link :name="'qa-packaging'"> 10. Packaging</li-link>
              <li-link :name="'qa-printing'"> 11. Printing</li-link>
              <li-link :name="'qa-claims'"> 12. Claims</li-link> -->
            </ul>
          </div>
        </div>
        <div class="col-lg-9 col-md-8 col-xs-7">
          <div class="box m-b-30">
            <div class="col-md-12">
              <p class="text-left">
                Please complete all pages in full as you cannot progress to the
                next section until the current section is fully completed.
              </p>
              <table class="table text-left text-left">
                <thead class="font-sm thead-dark">
                  <th scope="col">PRODUCT</th>
                  <th scope="col">CATEGORY</th>
                  <th scope="col">CUSTOMER</th>
                  <th scope="col">BRANDED / PL</th>
                  <th scope="col">BRAND</th>
                  <th scope="col">LAUNCH DATE</th>
                </thead>
                <tbody>
                  <tr>
                    <td class="dim2 text-left">
                      Test item 1
                    </td>
                    <td class="dim2 text-left vertical-center">
                      <span class="multi-wrap">One</span>
                      <span class="multi-wrap">Two</span>
                      <span class="multi-wrap">Three</span>
                    </td>
                    <td class="dim2">
                      Woolworths South Africa
                    </td>
                    <td class="dim2">
                      Branded
                    </td>
                    <td class="dim2">???</td>
                    <td class="dim2"></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div>
            <router-view></router-view>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
// @ is an alias to /src
import LiLink from "../components/LiLink";

export default {
  name: "Home",
  components: {
    LiLink
  },
  data() {
    return {
      activeClass: "selected"
    };
  }
};
</script>
<style lang="scss">

</style>
