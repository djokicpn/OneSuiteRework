<template>
    <div>
        <div class="box m-b-30">
            <div class="col-md-12 text-left">
                <h4>
                    2.1
                    <span class="user-input">RECIPE & RAW MATERIAL</span>
                </h4>
                <table class="table table-borderless">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th width="37%" class="user-input">Ingredient</th>
                            <th width="5%" class="user-input">
                                %
                            </th>
                            <th width="45%">
                                Compound Ingredient (if applicable)
                            </th>
                            <th width="13%" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="(ingredient, index) in ingredients"
                            :key="ingredient.id"
                        >
                            <th scope="row">{{ index + 1 }}</th>
                            <td>{{ ingredient.name }}</td>
                            <td>{{ ingredient.perc }} %</td>
                            <td>
                                <span
                                    class="multi-wrap"
                                    v-for="compound in ingredient.compound"
                                    :key="compound.id"
                                    >{{ compound.name }} (
                                    {{ compound.compound_perc }}% )</span
                                >
                            </td>
                            <td class="text-right">
                                <button
                                    class="btn btn-sm btn-primary btn-smaller"
                                    @click="showModal(ingredient)"
                                >
                                    Edit
                                </button>
                                &nbsp;
                                <button
                                    class="btn btn-sm btn-danger btn-smaller"
                                >
                                    Delete
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <button class="btn btn-warning">Add Ingredient</button>
            </div>
        </div>

        <!--2.2-->
        <div class="box">
            <div class="col-md-12 text-left">
                <h4>
                    2.2
                    <span class="user-input"
                        >RAW MATERIAL COUNTRY OF ORIGIN</span
                    >
                </h4>
                <table class="table table-borderless">
                    <thead class="thead-dark">
                        <th class="no-wrap">Ingredient</th>
                        <th class="no-wrap">Ing. %</th>
                        <th class="no-wrap">Overall %</th>
                        <th>Ing. Supplier</th>
                        <th>Supplier Site Location Address</th>
                        <th>Country of Origin</th>
                        <th>Country Where Processed (if different)</th>
                    </thead>
                    <tbody>
                        <tr
                            v-for="(ingredient, index) in ingredients"
                            :key="ingredient.id"
                        >
                            <td class="no-wrap">
                                {{ index + 1 + ". " + ingredient.name }}
                            </td>
                            <td>{{ ingredient.perc }}</td>
                            <td>{{ ingredient.percentage }}</td>
                            <td>
                                <input
                                    type="text"
                                    class="form-control"
                                    :value="ingredient.supplier"
                                />
                            </td>
                            <td>
                                <input
                                    type="text"
                                    class="form-control"
                                    :value="ingredient.supplier_location"
                                />
                            </td>
                            <td>
                                <select name="" class="form-control">
                                    <option value="999">Please select</option>
                                    <option
                                        v-for="country in countries"
                                        :value="country.id"
                                        :key="country.id"
                                        v-bind:selected="
                                            country.id === 1 && country.id
                                                ? 'selected'
                                                : ''
                                        "
                                    >
                                        {{ country.name }}</option
                                    >
                                </select>
                            </td>
                            <td>
                                <select name="" class="form-control">
                                    <option value="999">Please select</option>
                                </select>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <modal
            v-if="modalVisible"
            @close="modalVisible = false"
            @save-clicked="clickedSave"
            :title="'Test'"
            :buttonSave="'Save'"
            :buttonClose="'Close'"
            name="Umesh"
        >
            <model-select
                :options="options"
                v-model="item"
                placeholder="select item"
            >
            </model-select>
            <span>Editing Ingredient: {{ selectedIngredient.name }}</span>
            <br /><br />
            <div v-if="selectedIngredient.compound.length > 0"> <span>Compounds:</span>
            <br /><br />
            <p
                v-for="compound in selectedIngredient.compound"
                :key="compound.id"
            >
                {{ compound.name }}
            </p>
            </div>
            <div v-else>
                <span>This ingredient don't have any compound ingredients</span>
            </div>
        </modal>
    </div>
</template>
<script>
import Modal from "../components/Modal";
import _ from "lodash";
// import { MultiSelect } from "vue-search-select";
// import { ModelListSelect } from "vue-search-select";
import { ModelSelect } from "vue-search-select";

export default {
    name: "RecipeRaw",
    components: {
        Modal,
        // MultiSelect,
        // ModelListSelect,
        ModelSelect
    },
    watch: {
        item: function(item) {
            console.log(item);
        },
        selectedIngredient: function(ing) {
            console.log(ing);
        }
    },
    data() {
        return {
            selectedIngredient: {},
            countries: [
                { id: 1, name: "USA" },
                { id: 2, name: "CAD" },
                { id: 3, name: "SRB" }
            ],
            options: [
                { value: "1", text: "aa" + " - " + "1" },
                { value: "2", text: "ab" + " - " + "2" },
                { value: "3", text: "bc" + " - " + "3" },
                { value: "4", text: "cd" + " - " + "4" },
                { value: "5", text: "de" + " - " + "5" }
            ],
            item: {
                value: "",
                text: ""
            },
            ingredients: {},
            searchText: "", // If value is falsy, reset searchText & searchItem
            items: [],
            lastSelectItem: {},
            name: "Michael",
            modalVisible: false,
            myCounter: 0
        };
    },
    mounted() {
        this.renderTable();
    },
    methods: {
        showModal(ingredient) {
            this.selectedIngredient = ingredient;
            console.log(ingredient);
            this.modalVisible = true;
        },
        renderTable() {
            axios.get("/api/ingredients/list").then(response => {
                console.log(response.data);
                this.ingredients = response.data.data;
            });
        },
        clickedSave() {
            console.log(++this.myCounter);
        },
        searchInit(search) {
            axios.get("/api/categories").then(response => {
                const data = JSON.parse(JSON.stringify(response.data.data));
                const options = JSON.parse(JSON.stringify(this.options));
                console.log(data);
                console.log(options);
            });
        },
        onSelect(items, lastSelectItem) {
            this.items = items;
            this.lastSelectItem = lastSelectItem;
        },
        // deselect option
        reset() {
            this.items = []; // reset
        },
        // select option from parent component
        selectFromParentComponent() {
            this.items = _.unionWith(this.items, [this.options[0]], _.isEqual);
        }
    }
};
</script>
