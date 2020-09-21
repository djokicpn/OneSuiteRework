<template>
    <div>
        <div class="box ">
            <div class="col-md-12 text-left">
                <h4>
                    1.
                    <span class="text-warning">GENERAL INFORMATION</span>
                </h4>

                <!-- Document Table Start -->

                <table class="table table-striped text-left">
                    <thead class="thead-dark">
                        <th scope="col">
                            DOCUMENT CHECK LIST TO COMPLETE THIS SPECIFICATION
                        </th>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="dim2 font-sm">
                                Food Safety Certificates &
                            </td>
                        </tr>
                        <tr>
                            <td class="dim2 font-sm">
                                Nutritional test reports - Certificate of
                                Analysis
                            </td>
                        </tr>
                        <tr>
                            <td class="dim2 font-sm">
                                Product Manufacturing flow chart
                            </td>
                        </tr>
                        <tr>
                            <td class="dim2 font-sm">HACCPP Plan</td>
                        </tr>
                        <tr>
                            <td class="dim2 font-sm">
                                Allergen Mangement Plan
                            </td>
                        </tr>
                        <tr>
                            <td class="dim2 font-sm">
                                Relevant certifications & Claim Verification:
                                Organic, Kosher, etc.
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!-- Next button -->
                <div class="col-md-12 text-right">
                    <router-link :to="{ name: 'qa-recipe-raw' }">
                        <button class="btn btn-success pull-right">
                            Next
                        </button>
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</template>
