<template>
    <div>
        <div class="box m-b-30">
            <div class="col-md-12 text-left">
                <h4>
                    2.1
                    <span class="text-warning">RECIPE & RAW MATERIAL</span>
                </h4>
                <table class="table table-borderless">
                    <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th width="25%" class="user-input">Ingredient</th>
                        <th width="13%" class="user-input">
                            % Single Ingredient
                        </th>
                        <th>Compound Ingredient (if applicable)</th>
                        <th width="13%" class="text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr
                        v-for="ingredient in ingredients"
                        :key="ingredient.id"
                    >
                        <th scope="row">1</th>
                        <td>{{ ingredient.name }}</td>
                        <td>
                            {{ ingredient.percentage }}
                        </td>
                        <td>
                                <span
                                    class="multi-wrap"
                                    v-for="compound in ingredient.compound"
                                    :key="compound.id"
                                >{{ compound.name }}</span
                                >
                        </td>
                        <td class="text-right">
                            <button
                                class="btn btn-sm btn-primary btn-smaller"
                                @click="showModal = true"
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
                    <span class="text-warning"
                    >RAW MATERIAL COUNTRY OF ORIGIN</span
                    >
                </h4>
                <table class="table table-borderless">
                    <thead class="thead-dark">
                    <th>Ingredient Name</th>
                    <th>Ingredient %</th>
                    <th>Overall %</th>
                    <th>Ingredient Supplier</th>
                    <th>Supplier Site Location Address</th>
                    <th>Country of Origin</th>
                    <th>Country Where Processed (if different)</th>
                    </thead>
                    <tbody>
                    <tr v-for="ingredient in ingredients" :key="ingredient.id">

                        <td>{{ ingredient.name }}</td>
                        <td>{{ ingredient.percentage }}</td>
                        <td>{{ ingredient.percentage }}</td>
                        <td>
                            <input type="text" class="form-control" :value="ingredient.supplier">
                        </td>
                        <td>
                            <input type="text" class="form-control" :value="ingredient.supplier_location">
                        </td>
                        <td>
                            <select name="" class="form-control">
                                <option value="999">Please select</option>
                                <option v-for="country in countries" :value="country.id" v-bind:selected="country.id === 1 && country.id ? 'selected' : ''"> {{ country.name }}</option>
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
            v-if="showModal"
            @close="showModal = false"
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
        }
    },
    data() {
        return {
            countries: [
                {id: 1, name: 'USA'},
                {id: 2, name: 'CAD'},
                {id: 3, name: 'SRB'}
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
            showModal: false,
            myCounter: 0
        };
    },
    mounted() {
        this.renderTable();
    },
    methods: {
        renderTable() {
            axios.get("/api/ingredients/list").then(response => {
                console.log(response.data);
                this.ingredients = response.data;
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
