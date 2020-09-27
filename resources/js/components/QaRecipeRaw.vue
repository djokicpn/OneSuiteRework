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
                        <td>
                            <div v-if="editIndex === index">
                                          <!-- :value='{id: ingredientToEdit.id, name: ingredientToEdit.name}' -->
                                <v-select label="name" :filterable="false"
                                          :value='{id: ingredientToEdit.id, name: ingredientToEdit.name}'
                                          :options="selectOptions"
                                          @input="setSelected"
                                          @search="onSearch"
                                          ref="dropdown"
                                          >
                                          <template slot="no-options">
                                            type to search ingredients...
                                            </template>
                                </v-select>
                            </div>
                            <div v-else>
                                {{ ingredient.name }}
                            </div>
                        </td>
                        <td>
                            <div v-if="editIndex === index">
                                <input
                                    type="number"
                                    class="form-control smaller-input"
                                    :placeholder="100-ingredientPercentageSum.sum + ' %'"
                                    ref="ingPerc"
                                    v-model="ingredientToEdit.perc"
                                />
                            </div>

                            <div v-else>
                                 {{ ingredient.perc }} %
                            </div>
                        </td>
                        <td>
                             
                            <div v-if="editIndex === index">
                                <template style="margin-bottom: 5px !important" v-for="(cmp, index) in ingredientToEdit.compound" >
                                    <span class="multi-wrap">
                                        {{ cmp.name }} ({{ cmp.compound_perc }} % )
                                    </span>
                                    <span class="multi-wrap-danger" @click="deleteEditCmp(index)">
                                        Delete
                                    </span>
                                    <br/>
                                </template>
                                <div class="d-flex flex-nowrap">
                                    <v-select style="max-width: 325px; min-width:300px" label="name" :filterable="false"
                                            :options="selectOptions"
                                            :value="compoundToAdd"
                                            @keyup.enter.exact="focusNonEmpty($event.target.value,'cmpPerc')"
                                            @input="setSelectedComp"
                                            @search="onSearch"
                                            ref="cmpAddSelect">
                                    </v-select>
                                    <input
                                        type="number"
                                        class="form-control smaller-input"
                                        :placeholder="100-compoundPercentageSum + ' %'"
                                        style="margin: 0px 20px 0px 20px; max-width: 65px"
                                        v-model="compoundToAdd.perc"
                                        ref="cmpPerc"
                                        @keyup.enter.prevent="
                                                addCompound()
                                            "
                                    />
                                    <button
                                        class="nowrap"
                                        :class="addCompoundShow === true? 'btn btn-success btn-sm': 'btn btn-warning btn-sm'"
                                        @click="addCompound"
                                        :disabled="compoundPercentageSum > 100 || !ingredientPercentageSum.valid">
                                        {{ addCompoundShow === true ? "Save" : "Add" }} Compound
                                    </button>
                                </div>
                                <span v-if="compoundPercentageSum > 100" class="text-danger">Sum of Compounds percentagemust be exactly 100.</span>
                            </div>
                            <div v-else>
                                <span class="multi-wrap" v-for="compound in ingredient.compound" :key="compound.id" >
                                    {{ compound.name }} ( {{ compound.compound_perc }}% )
                                </span>
                            </div>
                        </td>
                        <td class="text-right">
                            <div v-if="editIndex === index" style="display:inline !important">
                                <button class="btn btn-sm btn-success" @click="editIndex = null">Save</button>
                            </div>
                            <div v-else>
                                <button class="btn btn-sm btn-primary btn-smaller" @click="editIngredient(ingredient,index)"> Edit</button>&nbsp;
                                <button class="btn btn-sm btn-danger btn-smaller" @click="deleteIngredient(ingredient,index)"> Delete</button>
                            </div>
                        </td>
                    </tr>
                    <transition name="fade">
                        <tr v-if="addIngredient">
                            <td>#</td>
                            <td>
<!--                                <input-->
<!--                                    type="text"-->
<!--                                    class="form-control smaller-input"-->
<!--                                    placeholder="Name"-->
<!--                                    v-model="ingredientToAdd.name"-->
<!--                                    @blur="-->
<!--                                            $event.target.value.length === 0-->
<!--                                                ? (addIngredient = false)-->
<!--                                                : (addIngredient = true)-->
<!--                                        "-->
<!--                                    @keyup.enter.exact="-->
<!--                                            focusNonEmpty(-->
<!--                                                $event.target,-->
<!--                                                'ingPerc'-->
<!--                                            )-->
<!--                                        "-->
<!--                                    ref="search"-->
<!--                                />-->
                                <v-select label="name" :filterable="false"
                                          :value='ingredientToAdd'
                                          :options="selectOptions"
                                          @keyup.enter.exact="focusNonEmpty($event.target.value,'ingPerc')"
                                          @input="setSelected"
                                          @search="onSearch"
                                          ref="dropdown"
                                          >
                                          <template slot="no-options">
                                            type to search ingredients...
                                            </template>
                                </v-select>
                            </td>


                            <td>
                                <input
                                    type="number"
                                    class="form-control smaller-input"
                                    :placeholder="100-ingredientPercentageSum.sum + ' %'"
                                    ref="ingPerc"
                                    @keyup.enter.exact="!ingredientPercentageSum.valid  ? false : $refs.cmpAddSelect.$refs.search.focus()"
                                    v-model="ingredientToAdd.perc"
                                />
                            </td>
                            <td>
                                <transition name="slide-fade">
                                    <div class="compound-area" v-if="ingredientToAdd.name.length > 0 && ingredientToAdd.perc > 0">
                                        <template style="margin-bottom: 5px !important" v-for="(cmp, index) in compoundsToAdd">
                                            <span class="multi-wrap">
                                                {{ cmp.name }} ({{ cmp.perc }} % )
                                            </span>
                                            <span class="multi-wrap-danger" @click="deleteCmp(index)">
                                                Delete
                                            </span>
                                            <br/>
                                        </template>
                                        <div class="d-flex flex-nowrap">
                                            <!-- <input
                                                type="text"
                                                class="form-control smaller-input"
                                                placeholder="Compound Ingredient Name"
                                                style="max-width: 325px"
                                                v-model="compoundToAdd.name"
                                                @keyup.enter.exact="
                                                        focusNonEmpty(
                                                            $event.target.value,
                                                            'cmpPerc'
                                                        )
                                                    "
                                                ref="cmpAdd"
                                            /> -->
                                            <v-select style="max-width: 325px; min-width:300px" label="name" :filterable="false"
                                                    :options="selectOptions"
                                                    :value="compoundToAdd"
                                                    @keyup.enter.exact="focusNonEmpty($event.target.value,'cmpPerc')"
                                                    @input="setSelectedComp"
                                                    @search="onSearch"
                                                    ref="cmpAddSelect">
                                            </v-select>
                                            <input
                                                type="number"
                                                class="form-control smaller-input"
                                                :placeholder="100-compoundPercentageSum + ' %'"
                                                style="margin: 0px 20px 0px 20px; max-width: 65px"
                                                v-model="compoundToAdd.perc"
                                                ref="cmpPerc"
                                                @keyup.enter.prevent="
                                                        addCompound()
                                                    "
                                            />
                                            <button
                                                class="nowrap"
                                                :class="addCompoundShow === true? 'btn btn-success btn-sm': 'btn btn-warning btn-sm'"
                                                @click="addCompound"
                                                :disabled="compoundPercentageSum > 100 || !ingredientPercentageSum.valid">
                                                {{ addCompoundShow === true ? "Save" : "Add" }} Compound
                                            </button>
                                        </div>
                                        <span v-if="compoundPercentageSum > 100" class="text-danger">Sum of Compounds percentagemust be exactly 100.</span>
                                    </div>
                                </transition>
                            </td>
                        </tr>
                    </transition>

                    <tr v-if="ingredients.length > 0">
                        <td></td>
                        <td class="text-right"><b>TOTAL:</b></td>
                        <td :class="!ingredientPercentageSum.valid ? 'text-danger': '' ">
                            {{ ingredientPercentageSum.sum }} %
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="text-center">
                    <pulse-loader v-if="loadingIngredients"></pulse-loader>
                </div>
                <button :class="this.addIngredient === true ? 'btn btn-success' : 'btn btn-warning'" @click="addIngredientSubmit">
                    {{ addIngredient === true ? "Save" : "Add" }} Ingredient
                </button>
                <br/>
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
                                    >Please select
                                    </option
                                    >
                                    <option
                                        v-for="country in countries"
                                        :value="country.id"
                                        :key="country.id"
                                        v-bind:selected="country.id === 1 && country.id ? 'selected' : '' ">
                                        {{ country.name }}
                                    </option>
                                </select>
                            </td>
                            <td>
                                <select name="" class="form-control">
                                    <option value="999"
                                    >Please select
                                    </option>
                                </select>
                            </td>
                        </tr>
                        <tr
                            v-for="(compound,
                                compound_index) in ingredient.compound"
                            :key="compound.id"
                        >
                            <td class="no-wrap p-l-5">
                                {{index + 1 + "." + (compound_index + 1) + " " +compound.name}}
                            </td>
                            <td>{{ compound.perc }}</td>
                            <td>
                                {{((ingredient.perc *compound.compound_perc) / 100).toFixed(2)}} %
                            </td>
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
                                    >Please select
                                    </option
                                    >
                                    <option
                                        v-for="country in countries"
                                        :value="country.id"
                                        :key="country.id"
                                        v-bind:selected="country.id === 1 && country.id? 'selected': ''">
                                        {{ country.name }}
                                    </option>
                                </select>
                            </td>
                            <td>
                                <select name="" class="form-control">
                                    <option value="999"
                                    >Please select
                                    </option
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
                    <button
                        type="button"
                        class="btn btn-primary "
                        @click="validatePage($event)"
                    >
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
            <br/><br/>
            <div v-if="selectedIngredient.compound.length > 0">
                <span>Compounds:</span> <br/><br/>
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
        totalPerc: function (perc) {
            if (perc > 100)
                this.$toast.warning(`Ingredient total can't exceed 100. You are ${perc - 100} over a value!`);
        },
        item: function (item) {
            console.log(item);
        },
        selectedIngredient: function (ing) {
            console.log(ing);
        }
    },
    data() {
        return {
            editIndex: null,
            selectOptions: [],
            totalPerc: 0,
            loadingIngredients: true,
            show: true,
            compoundToAdd: {
                name: "",
                perc: ""
            },
            compoundsToAdd: [],
            ingredientToAdd: {
                name: "",
                perc: "",
            }, 
            ingredientToEdit: {
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
            items: [],
            modalVisible: false,
        };
    },
    mounted() {
        this.loadIngredients();
    },
    methods: {
        editingIngredient(index) {
            return index === this.editIndex;
        },
        editIngredient(ingredient,index) {
            this.editIndex = index;
            this.ingredientToEdit = ingredient;
            this.editingIngredient = true;
        },
        setSelected(value) {

            this.ingredientToAdd.id = value.id
            this.ingredientToAdd.name = value.name
            this.focusNonEmpty("value",'ingPerc')

        },
        setSelectedComp(value) {

            this.compoundToAdd.id = value.id
            this.compoundToAdd.name = value.name
            this.focusNonEmpty("value",'cmpPerc')

        },
        onSearch(search, loading) {
            loading(true);
            this.search(loading, search, this);
        },
        search: _.debounce((loading, search, vm) => {
                fetch(
                    `/api/ingredients/search?query=${escape(search)}`
                ).then(res => {
                    res.json().then(json => (vm.selectOptions = json));
                    loading(false);
                });
        }, 350),
        focusNonEmpty(value, ref) {
            if (value.length > 0)
                this.$nextTick(function () {
                    this.$refs[ref].focus();
                });
        },
        addIngredientSubmit () {
            if (!this.ingredientPercentageSum.valid) {
                this.$toast.warning(`Ingredient total can't exceed 100. You are ${this.ingredientPercentageSum.sum - 100} over a value!`);
                return
            }
            if (this.addIngredient === true)
                if (this.ingredientToAdd.name.length === 0 || this.ingredientToAdd.perc.length === 0) {
                    this.$toast.warning(`Both name and percentage are mandatory!`);
                    return
                }
            if (!this.addIngredient) {
                this.addIngredient = true;
                this.$nextTick(function () {
                    this.$refs.dropdown.$refs.search.focus()
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
        deleteEditCmp(index) {
            this.ingredientToEdit.compound.splice(index, 1);
        },
        deleteIngredient(ing,index) {
            this.$swal({
                icon: 'warning',
                title: `Deleting "${ing.name}"`,
                text: 'Are you sure that you want do delete this ingredient?',
                showCancelButton: true,
                confirmButtonColor: '#e3342f',
                cancelButotonColor: '#2cabe3',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    this.loadingIngredients = true;
                    axios.post('/api/ingredients/delete', {id: ing.id}).then((response) => {
                        this.$toast.open(`${ing.name} successfuly deleted!`);
                        this.ingredients.splice(index,1);
                        this.loadIngredients();
                        // this.loadingIngredients = false;
                    });
                }
            });
        },
        addCompound() {
            if (!this.compoundToAdd.name.length > 1 || !this.compoundToAdd.perc > 0) {
                return
            }

            this.addCompoundShow === !this.addCompoundShow;
            this.compoundsToAdd.push(this.compoundToAdd);
            this.$toast.open(`${this.compoundToAdd.name} added to ${this.ingredientToAdd.name} as compound (${this.compoundToAdd.perc} %)`);
            this.compoundToAdd = {};
            this.$refs.cmpAddSelect.$refs.search.focus()


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
            axios.get("/api/countries/list").then(response => {
                this.ingredients = response.data.data;
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
            if (this.ingredientPercentageSum.valid !== 100) {
                e.preventDefault();
                return;
            }
        }
    },
    computed: {
   
        ingredientPercentageSum() {
            console.log('event fired')
            let sum = 0;
            if (this.ingredients != null && Object.keys(this.ingredients).length != 0) {
                this.ingredients.forEach(e => {
                    sum += parseInt(e.perc)
                });
                sum = sum + (parseInt(this.ingredientToAdd.perc) > 0 ? parseInt(this.ingredientToAdd.perc) : 0)
                this.totalPerc != sum ? this.totalPerc = sum : false;
            }
            return {
                sum: sum,
                valid: sum <= 100
            };
        },
        compoundPercentageSum() {
            let sum = 0;
            if (this.compoundsToAdd.length > 0) {
                this.compoundsToAdd.forEach(e => {
                    sum += parseInt(e.perc);
                })
                sum = sum + (parseInt(this.compoundToAdd.perc) > 0 ? parseInt(this.compoundToAdd.perc) : 0)
            }
            return sum;
        }
    }
};
</script>
