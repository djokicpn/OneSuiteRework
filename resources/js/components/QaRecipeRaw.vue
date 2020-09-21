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
                                    @click="deleteIngredient(ingredient)"
                                >
                                    Delete
                                </button>
                            </td>
                        </tr>
                        <transition name="fade">
                            <tr v-if="addIngredient">
                                <td>#</td>
                                <td>
                                    <input
                                        type="text"
                                        class="form-control smaller-input"
                                        placeholder="Name"
                                        v-model="ingredientToAdd.name"
                                        ref="search"
                                    />
                                </td>

                                <td>
                                    <input
                                        type="number"
                                        class="form-control smaller-input"
                                        placeholder="%"
                                        v-model="ingredientToAdd.perc"
                                    />
                                </td>

                                <td>
                                    <transition name="slide-fade">
                                        <div
                                            class="compound-area"
                                            v-if="
                                                ingredientToAdd.name.length >
                                                    0 &&
                                                    ingredientToAdd.perc > 0
                                            "
                                        >
                                            <template
                                                style="margin-bottom: 5px !important"
                                                v-for="(cmp,
                                                index) in compoundsToAdd"
                                            >
                                                <span class="multi-wrap">
                                                    {{ cmp.name }} (
                                                    {{ cmp.perc }} % )
                                                </span>
                                                <span
                                                    class="multi-wrap-danger"
                                                    @click="deleteCmp(index)"
                                                    >Delete</span
                                                >
                                                <br />
                                            </template>
                                            <div class="d-flex flex-nowrap">
                                                <input
                                                    type="text"
                                                    class="form-control smaller-input"
                                                    placeholder="Compound Ingredient Name"
                                                    style="max-width: 325px"
                                                    v-model="compoundToAdd.name"
                                                    ref="cmpAdd"
                                                />
                                                <input
                                                    type="number"
                                                    class="form-control smaller-input"
                                                    placeholder="%"
                                                    style="margin: 0px 20px 0px 20px; max-width: 65px"
                                                    v-model="compoundToAdd.perc"
                                                    @keyup.enter.prevent="
                                                        addCompound()
                                                    "
                                                />
                                                <button
                                                    class="nowrap"
                                                    :class="
                                                        addCompoundShow === true
                                                            ? 'btn btn-success btn-sm'
                                                            : 'btn btn-warning btn-sm'
                                                    "
                                                    @click="addCompound"
                                                    :disabled="
                                                        compoundPercentageSum() +
                                                            parseInt(
                                                                compoundToAdd.perc
                                                            ) >
                                                        100
                                                            ? true
                                                            : false
                                                    "
                                                >
                                                    {{
                                                        addCompoundShow === true
                                                            ? "Save"
                                                            : "Add"
                                                    }}
                                                    Compound
                                                </button>
                                            </div>
                                            <span
                                                v-if="
                                                    compoundPercentageSum() +
                                                        parseInt(
                                                            compoundToAdd.perc
                                                        ) >
                                                        100
                                                "
                                                class="text-danger"
                                                >Sum of Compounds percentage
                                                must be exactly 100.</span
                                            >
                                        </div>
                                    </transition>
                                </td>
                            </tr>
                        </transition>
                    </tbody>
                </table>
                <div class="text-center">
                    <pulse-loader v-if="loadingIngredients"></pulse-loader>
                </div>
                <button
                    :class="
                        this.addIngredient === true
                            ? 'btn btn-success'
                            : 'btn btn-warning'
                    "
                    :disabled="
                        ingredientPercentageSum() +
                            parseInt(ingredientToAdd.perc) >
                        100
                            ? true
                            : false
                    "
                    @click="addIngredientSubmit"
                >
                    {{ addIngredient === true ? "Save" : "Add" }} Ingredient
                </button>
                <br />
                <span
                    class="text-danger"
                    v-if="
                        ingredientPercentageSum() +
                            parseInt(ingredientToAdd.perc) >
                            100
                    "
                    >Sum of <b>Ingredients</b> percentage must be exactly
                    <b>100</b>.
                </span>
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
                        <template v-for="(ingredient, index) in ingredients">
                            <tr class="main-ingredient">
                                <td class="no-wrap">
                                    {{ index + 1 + ". " + ingredient.name }}
                                </td>
                                <td>{{ ingredient.perc }} %</td>
                                <td>{{ ingredient.percentage }}</td>
                                <td>
                                    <input
                                        type="text"
                                        class="form-control"
                                        :value="ingredient.supplier"
                                        placeholder="Supplier name"
                                    />
                                </td>
                                <td>
                                    <input
                                        type="text"
                                        class="form-control"
                                        :value="ingredient.location"
                                        placeholder="Location"
                                    />
                                </td>
                                <td>
                                    <select name="" class="form-control">
                                        <option value="999"
                                            >Please select</option
                                        >
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
                                            {{ country.name }}
                                        </option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" class="form-control">
                                        <option value="999"
                                            >Please select</option
                                        >
                                    </select>
                                </td>
                            </tr>
                            <tr
                                v-for="(compound,
                                compound_index) in ingredient.compound"
                                :key="compound.id"
                            >
                                <td class="no-wrap p-l-5">
                                    {{
                                        index +
                                            1 +
                                            "." +
                                            (compound_index + 1) +
                                            " " +
                                            compound.name
                                    }}
                                </td>
                                <td>{{ compound.perc }}</td>
                                <td>{{ compound.compound_perc }} %</td>
                                <td>
                                    <input
                                        type="text"
                                        class="form-control"
                                        :value="compound.supplier"
                                        placeholder="Supplier name"
                                    />
                                </td>
                                <td>
                                    <input
                                        type="text"
                                        class="form-control"
                                        :value="compound.location"
                                        placeholder="Location"
                                    />
                                </td>
                                <td>
                                    <select name="" class="form-control">
                                        <option value="999"
                                            >Please select</option
                                        >
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
                                            {{ country.name }}
                                        </option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" class="form-control">
                                        <option value="999"
                                            >Please select</option
                                        >
                                    </select>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
                <div class="text-center">
                    <pulse-loader v-if="loadingIngredients"></pulse-loader>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <router-link :to="{ name: 'qa-general' }">
                    <button type="button" class="btn btn-secondary mr-auto">
                        Back
                    </button>
                </router-link>
                <router-link :to="{ name: 'qa-ingredient-dec' }">
                    <button type="button" class="btn btn-primary " @click="validatePage($event)">
                        Next
                    </button>
                </router-link>
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
            <div v-if="selectedIngredient.compound.length > 0">
                <span>Compounds:</span> <br /><br />
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
import {ModelSelect} from "vue-search-select";

export default {
    name: "RecipeRaw",
    components: {
        Modal,
        // MultiSelect,
        // ModelListSelect,
        ModelSelect
    },
    watch: {
        item: function (item) {
            console.log(item);
        },
        selectedIngredient: function (ing) {
            console.log(ing);
        }
    },
    data() {
        return {
            loadingIngredients: true,
            show: true,
            compoundToAdd: {
                name: "",
                perc: null
            },
            compoundsToAdd: [],
            ingredientToAdd: {
                name: "",
                perc: "",
            },
            addIngredient: false,
            addCompoundShow: false,
            // percentageError: false,
            selectedIngredient: {},
            countries: [
                {id: 1, name: "USA"},
                {id: 2, name: "CAD"},
                {id: 3, name: "SRB"}
            ],
            options: [
                {value: "1", text: "aa" + " - " + "1"},
                {value: "2", text: "ab" + " - " + "2"},
                {value: "3", text: "bc" + " - " + "3"},
                {value: "4", text: "cd" + " - " + "4"},
                {value: "5", text: "de" + " - " + "5"}
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
        this.loadIngredients();
    },
    methods: {
        addIngredientSubmit() {
            if(this.addIngredient === true)
                if(this.ingredientToAdd.name.length === 0 || this.ingredientToAdd.perc.length === 0) {
                    this.$toast.warning(`Both name and percentage are mandatory!`);
                    return
                }
            if(!this.addIngredient) {
                this.addIngredient = true;
                this.$nextTick(function() {
                    this.$refs.search.focus();
                });
            } else {
                let data = {
                    ingredient: this.ingredientToAdd,
                    compounds: this.compoundsToAdd
                }
                this.loadingIngredients = true;
                 axios.post("/api/ingredients/save", {data: data}).then(response => {
                     this.$toast.open(`${this.ingredientToAdd.name} ingredient successfuly added!`);
                    this.ingredients = response.data.data;
                    this.loadIngredients();
                    this.addCompoundShow = false;
                    this.compoundsToAdd = [];
                    this.addIngredient = false;
                    this.ingredientToAdd.name = '';
                    this.ingredientToAdd.perc = null;
                });
            }


        },
        focusInput: function (inputRef) {
            // $refs is an object that holds the DOM references to your inputs
            this.$refs.[inputRef][0].focus();
        },
        deleteCmp(index) {
            this.compoundsToAdd.splice(index, 1);
        },
        deleteIngredient(ing) {
            this.$swal({
                icon: 'warning',
                title:`Deleting "${ing.name}"`,
                text: 'Are you sure that you want do delete this ingredient?',
                showCancelButton: true,
                confirmButtonColor: '#e3342f',
                cancelButotonColor: '#2cabe3',
                confirmButtonText: 'Yes, delete it!'
            }).then((result)=> {
                if(result.value) {
                    this.loadingIngredients = true;
                    axios.post('/api/ingredients/delete', {id : ing.id}).then((response) => {
                        this.$toast.open(`${ing.name} successfuly deleted!`);
                        this.loadIngredients();
                    });
                }
            });
        },
        addCompound() {
            if (!this.compoundToAdd.name.length > 1 || !this.compoundToAdd.perc > 0) {
                return
            }

            this.addCompoundShow ===  !this.addCompoundShow;
            this.compoundsToAdd.push(this.compoundToAdd);
            this.$toast.open(`${this.compoundToAdd.name} added to ${this.ingredientToAdd.name} as compound (${this.compoundToAdd.perc} %)`);
            this.compoundToAdd = {};
            this.$refs.cmpAdd.focus();


        },
        compoundPercentageSum() {
            let sum = 0;
            if (this.compoundsToAdd.length > 0) {
                this.compoundsToAdd.forEach(e => {
                    sum += parseInt(e.perc);
                })
                return sum;
            }
            return 0;
        },
        ingredientPercentageSum() {
            let sum = 0;
            if(this.ingredients.length > 0) {
                this.ingredients.forEach(e=> {
                    sum += parseInt(e.perc)
                });
                return sum;
            }
            return 0;
        },
        showModal(ingredient) {
            this.selectedIngredient = ingredient;
            console.log(ingredient);
            this.modalVisible = true;
        },
        loadIngredients() {
            axios.get("/api/ingredients/list").then(response => {
                this.ingredients = response.data.data;
                this.loadingIngredients = false;
            });
        },
        loadCountries() {
            axios.get("/api/ingredients/list").then(response => {
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
        },
        validatePage(e) {
            if(this.ingredientPercentageSum() !== 100) {
                 e.preventDefault();
                 return;
            }
        }
    }
};
</script>
